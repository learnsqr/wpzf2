<?php
namespace Contracts\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Contracts implements InputFilterAwareInterface
 {
     public $id;
     public $name;
     public $description;
     public $date;
     protected $inputFilter;                       // <-- Add this variable

     public function exchangeArray($data)
     {
         $this->idcontract = (isset($data['idcontract'])) ? $data['idcontract']   : null;
         $this->name         = (isset($data['name']))       ? $data['name']         : null;
         $this->description  = (isset($data['description']))? $data['description']  : null;
         $this->date         = (isset($data['date']))       ? $data['date']         : null;
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
                 'name'     => 'idcontract',
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
             		'name'     => 'date',
             		'required' => true,
             		'filters'  => array(
             				array('name' => 'StripTags'),
             				array('name' => 'StringTrim'),
             		),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }