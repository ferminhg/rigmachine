<?php
namespace Gear\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Gear\Model\Gear;
use Gear\Form\GearForm;

class GearController extends AbstractActionController
{
    protected $gearTable;
    protected $gearTableView;


    public function indexAction()
    {
        return new ViewModel(array(
            'gears' => $this->getGearTable()->getGears(),
        ));
    }

    public function addAction()
    {

    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }

    public function getGearTable()
    {
        if (!$this->gearTable) {
            $sm = $this->getServiceLocator();
            $this->gearTable = $sm->get('Gear\Model\GearTable');
        }
        return $this->gearTable;   
    }
}