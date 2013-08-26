<?php
namespace Band\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Band\Model\Band;
use Band\Form\BandForm;

class BandController extends AbstractActionController
{
    protected $bandTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'bands' => $this->getBandTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new BandForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $band = new Band();
            $form->setInputFilter($band->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $band->exchangeArray($form->getData());
                $this->getBandTable()->saveBand($band);

                // Redirect to list of Bands
                return $this->redirect()->toRoute('band');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('band', array(
                'action' => 'add'
            ));
        }

        // Get the Band with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $band = $this->getBandTable()->getBand($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('band', array(
                'action' => 'index'
            ));
        }

        $form  = new BandForm();
        $form->bind($band);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($band->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getBandTable()->saveBand($form->getData());

                // Redirect to list of Bands
                return $this->redirect()->toRoute('band');
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
            return $this->redirect()->toRoute('band');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getBandTable()->deleteBand($id);
            }

            // Redirect to list of Bands
            return $this->redirect()->toRoute('band');
        }

        return array(
            'id'    => $id,
            'band' => $this->getBandTable()->getBand($id)
        );
    }

    public function getBandTable()
    {
        if (!$this->bandTable) {
            $sm = $this->getServiceLocator();
            $this->bandTable = $sm->get('Band\Model\BandTable');
        }
        return $this->bandTable;
    }
}
