<?php
namespace Project\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Project implements InputFilterAwareInterface
 {
     public $idproject;
     public $name;
     public $description;
     public $budget;
     protected $inputFilter;                       // <-- Add this variable

     public function exchangeArray($data)
     {
         $this->idproject     = (isset($data['idproject']))     ? $data['idproject']     : null;
         $this->name = (isset($data['name'])) ? $data['name'] : null;
         $this->description  = (isset($data['description']))  ? $data['description']  : null;
         $this->budget  = (isset($data['budget']))  ? $data['budget']  : null;
     }

     // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getArrayCopy()
     {
     	return get_object_vars($this);
     }
     
     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'idproject',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'name',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'description',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
             		'name'     => 'budget',
             		'required' => true,
          
             ));
             
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
     }
