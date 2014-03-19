<?php
return array(		
    array(
    	'label' => 'Contracts',
    	'route' => 'contracts',
    	//'order' => 3,
    	'pages' => array(
	    	array(
	    		'label' => 'Add',
	    		'route' => 'contracts',
	    		'action' => 'add',
	    	),
	    	array(
	    		'label' => 'Edit',
	    		'route' => 'contracts',
	    		'action' => 'edit',
	    	),
	    	array(
	    		'label' => 'Delete',
	    		'route' => 'contracts',
	    		'action' => 'delete',
	    	),
    	),
	),
);