<?php
namespace Contracts\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Contracts\Model\Contracts;
use Contracts\Form\ContractsForm;

class IndexController extends AbstractActionController
{
	protected $contractsTable;
	
	public function getContractsTable()
	{
		if (!$this->contractsTable) {
			$sm = $this->getServiceLocator();
			$this->contractsTable = $sm->get('Contracts\Model\ContractsTable');
		}
		return $this->contractsTable;
	}
	
	public function indexAction()
    {
    	return new ViewModel(array(
    			'contracts' => $this->getContractsTable()->fetchAll(),
    	));
    }
    
	public function addAction()
     {
         $form = new ContractsForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $contract = new Contracts();
             $form->setInputFilter($contract->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $contract->exchangeArray($form->getData());
                 $this->getContractsTable()->saveContracts($contract);

                 // Redirect to list of s
                 return $this->redirect()->toRoute('contracts');
             }
         }
         return array('form' => $form);
     }
    
    public function editAction()
    {
         $id = (int) $this->params()->fromRoute('id', 0);  //OK
         if (!$id) {
             return $this->redirect()->toRoute('contracts', array(
                 'action' => 'add'
             ));
         }

         // Get the Contract with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $contract = $this->getContractsTable()->getContracts($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('contracts', array(
                 'action' => 'index'
             ));
         }

         $form  = new ContractsForm();
         $form->bind($contract);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($contract->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getContractsTable()->saveContracts($contract);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('contracts');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
    }
    
    public function deleteAction(){
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('contracts');
         }
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');
             if ($del == 'Yes') { 
             	$id = (int) $request->getPost('id');
                 $this->getContractsTable()->deleteContracts($id);
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('contracts');
         }
         
         return array(
             'id'    => $id,
             'contract' => $this->getContractsTable()->getContracts($id)
         );
    }
    
}
