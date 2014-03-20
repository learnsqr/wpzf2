<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Developer for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Developer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;
use Zend\Config\Reader;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$data = $this->params()->fromRoute('filename', 0);
    	
    	if(file_exists("C:\www\wpzf2\docs\developer\\".$data.".md"))
    		$data = file_get_contents("C:\www\wpzf2\docs\developer\\".$data.".md");
    	else 
    		$data=null;

    	return array('data' => $data);
    }

   
}
