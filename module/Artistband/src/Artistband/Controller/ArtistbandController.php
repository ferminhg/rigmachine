<?php
namespace Artistband\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Artistband\Model\Artistband;
use Artistband\Form\ArtistbandForm;

class ArtistbandController extends AbstractActionController
{
    protected $artistbandTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'artistbands' => $this->getArtistbandTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new ArtistbandForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $artistband = new Artistband();
            $form->setInputFilter($artistband->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $artistband->exchangeArray($form->getData());
                $this->getArtistbandTable()->saveArtistband($artistband);

                // Redirect to list of artistbands
                return $this->redirect()->toRoute('artistband');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('artistband', array(
                'action' => 'add'
            ));
        }

        // Get the Artistband with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $artistband = $this->getArtistbandTable()->getArtistband($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('artistband', array(
                'action' => 'index'
            ));
        }

        $form  = new ArtistbandForm();
        $form->bind($artistband);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($artistband->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getArtistbandTable()->saveArtistband($form->getData());

                // Redirect to list of artistbands
                return $this->redirect()->toRoute('artistband');
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
            return $this->redirect()->toRoute('artistband');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getArtistbandTable()->deleteArtistband($id);
            }

            // Redirect to list of artistbands
            return $this->redirect()->toRoute('artistband');
        }

        return array(
            'id'    => $id,
            'artistband' => $this->getArtistbandTable()->getArtistband($id)
        );
    }

    public function getArtistbandTable()
    {
        if (!$this->artistbandTable) {
            $sm = $this->getServiceLocator();
            $this->artistbandTable = $sm->get('Artistband\Model\ArtistbandTable');
        }
        return $this->artistbandTable;
    }
}
