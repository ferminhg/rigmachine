<?php
namespace Band\Form;

use Zend\Form\Form;

class BandForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('band');
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
            'name' => 'website',
            'type' => 'Text',
            'options' => array(
                'label' => 'Website',
            ),
        ));
        $this->add(array(
            'name' => 'info',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'info',
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