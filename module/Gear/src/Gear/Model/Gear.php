<?php
namespace Gear\Model;

use Geartype\Model\GeartypeTable;
use Brand\Model\Brand;


use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Gear
{
    public $id;
    public $name;
    public $geartype;
    public $geartype_id;
    public $brand;
    public $brand_id;
    public $img;
    public $web;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id   = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->img = (isset($data['img'])) ? $data['img'] : null;

        $this->geartype_id = (isset($data['geartype_id'])) ? $data['geartype_id'] : null;
        $this->geartype_name = (isset($data['geartype_name'])) ? $data['geartype_name'] : null;
        $this->brand_id = (isset($data['brand_id'])) ? $data['brand_id'] : null;
        $this->brand_name = (isset($data['brand_name'])) ? $data['brand_name'] : null;
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

    }
}