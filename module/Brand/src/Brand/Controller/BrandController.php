<?php
namespace Brand\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Brand\Model\Brand;
use Brand\Form\BrandForm;

class BrandController extends AbstractActionController
{
    protected $brandTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'brands' => $this->getBrandTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new BrandForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $brand = new Brand();
            $form->setInputFilter($brand->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $brand->exchangeArray($form->getData());
                $this->getBrandTable()->saveBrand($brand);

                return $this->redirect()->toRoute('brand');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('brand', array(
                'action' => 'add'
            ));
        }

        try {
            $brand = $this->getBrandTable()->getBrand($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('brand', array(
                'action' => 'index'
            ));
        }

        $form  = new BrandForm();
        $form->bind($brand);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($brand->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getBrandTable()->saveBrand($form->getData());

                return $this->redirect()->toRoute('brand');
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
            return $this->redirect()->toRoute('brand');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getBrandTable()->deleteBrand($id);
            }

            return $this->redirect()->toRoute('brand');
        }

        return array(
            'id'    => $id,
            'brand' => $this->getBrandTable()->getBrand($id)
        );
    }

    public function getBrandTable()
    {
        if (!$this->brandTable) {
            $sm = $this->getServiceLocator();
            $this->brandTable = $sm->get('Brand\Model\BrandTable');
        }
        return $this->brandTable;
    }
}
