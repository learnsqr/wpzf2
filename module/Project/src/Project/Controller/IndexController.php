<?php
namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Project\Model\Project;
use Project\Form\ProjectForm;

class IndexController extends AbstractActionController
{
	protected $projectTable;
	
	public function getProjectTable()
	{
		if (!$this->projectTable) {
			$sm = $this->getServiceLocator();
			$this->projectTable = $sm->get('Project\Model\ProjectTable');
		}
		return $this->projectTable;
	}
	
	public function indexAction()
    {
    	return new ViewModel(array(
    			'projects' => $this->getProjectTable()->fetchAll(),
    	));
    }
    
	public function addAction()
     {
         $form = new ProjectForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $project = new Project();
             $form->setInputFilter($project->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $project->exchangeArray($form->getData());
                 $this->getProjectTable()->saveProject($project);

                 // Redirect to list of projects
                 return $this->redirect()->toRoute('project');
             }
         }
         return array('form' => $form);
     }
    
    public function editAction()
    {
         $idproject = (int) $this->params()->fromRoute('idproject', 0);
         if (!$idproject) {
             return $this->redirect()->toRoute('project', array(
                 'action' => 'add'
             ));
         }

         // Get the Project with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $project = $this->getProjectTable()->getProject($idproject);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('project', array(
                 'action' => 'index'
             ));
         }

         $form  = new ProjectForm();
         $form->bind($project);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($project->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getProjectTable()->saveProject($project);

                 // Redirect to list of projects
                 return $this->redirect()->toRoute('project');
             }
         }

         return array(
             'idproject' => $idproject,
             'form' => $form,
         );
    }
    
	public function deleteAction()
    {
         $idproject = (int) $this->params()->fromRoute('idproject', 0);
         if (!$idproject) {
             return $this->redirect()->toRoute('project');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $idproject = (int) $request->getPost('idproject');
                 $this->getProjectTable()->deleteProject($idproject);
             }

             // Redirect to list of projects
             return $this->redirect()->toRoute('project');
         }

         return array(
             'idproject'    => $idproject,
             'project' => $this->getProjectTable()->getProject($idproject)
         );
    }
    
}