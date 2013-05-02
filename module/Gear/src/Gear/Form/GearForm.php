<?php
namespace Gear\Form;

use Zend\Form\Form;

class GearForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('gear');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name',
            ),
        ));
        $this->add(array(
            'name' => 'web',
            'type' => 'Text',
            'options' => array(
                'label' => 'website ',
            ),
        ));
        $this->add(array(
            'name' => 'img',
            'type' => 'TextArea',
            'options' => array(
                'label' => 'Link a imagen (data:image/jpeg; ... o url)',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}