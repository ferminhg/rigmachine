<?php
namespace Geartype\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Geartype\Model\Geartype;
use Geartype\Form\GeartypeForm;

class GeartypeController extends AbstractActionController
{
    protected $geartypeTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'geartypes' => $this->getGearTypeTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new GeartypeForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $geartype = new Geartype();
            $form->setInputFilter($geartype->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $geartype->exchangeArray($form->getData());
                $this->getGeartypeTable()->saveGeartype($geartype);

                return $this->redirect()->toRoute('geartype');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('geartype', array(
                'action' => 'add'
            ));
        }

        try {
            $geartype = $this->getGeartypeTable()->getGeartype($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('geartype', array(
                'action' => 'index'
            ));
        }

        $form  = new GearTypeForm();
        $form->bind($geartype);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($geartype->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getGeartypeTable()->saveGeartype($form->getData());

                return $this->redirect()->toRoute('geartype');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('geartype');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getGeartypeTable()->deleteGeartype($id);
            }

            return $this->redirect()->toRoute('geartype');
        }

        return array(
            'id'    => $id,
            'geartype' => $this->getGeartypeTable()->getGeartype($id)
        );
    }

    public function getGearTypeTable()
    {
        if (!$this->geartypeTable) {
            $sm = $this->getServiceLocator();
            $this->geartypeTable = $sm->get('GearType\Model\GearTypeTable');
        }
        return $this->geartypeTable;
    }
}
