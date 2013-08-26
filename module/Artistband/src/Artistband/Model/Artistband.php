<?php
namespace Artistband\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Artistband
{
    public $id;
    public $artist_id;
    public $band_id;
    public $inicio;
    public $fin;
    public $info;
    protected $inputFilter;  

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->artist_id = (isset($data['artist_id'])) ? $data['artist_id'] : null;
        $this->band_id = (isset($data['band_id'])) ? $data['band_id'] : null;
        $this->inicio = (isset($data['inicio'])) ? $data['inicio'] : null;
        $this->fin = (isset($data['fin'])) ? $data['fin'] : null;
        $this->info = (isset($data['info'])) ? $data['info'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            // $inputFilter->add($factory->createInput(array(
            //     'name'     => 'name',
            //     'required' => true,
            //     'filters'  => array(
            //         array('name' => 'StripTags'),
            //         array('name' => 'StringTrim'),
            //     ),
            //     'validators' => array(
            //         array(
            //             'name'    => 'StringLength',
            //             'options' => array(
            //                 'encoding' => 'UTF-8',
            //                 'min'      => 1,
            //                 'max'      => 100,
            //             ),
            //         ),
            //     ),
            // )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}
