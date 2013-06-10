<?php
namespace Gear\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;

class GearTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getGears()
    {
        $resultSet = $this->tableGateway->select(function(Select $select) {
            $select->join('brand', 'gear.brand_id = brand.id', array("brand_name" => "name"));
            $select->join('geartype', 'gear.geartype_id = geartype.id', array("geartype_name" => "name"));
            //echo $select->getSqlString();
        });
        return $resultSet;
    }

    public function getGear($id)
    {

    }

    public function saveGear(Gear $gear)
    {

    }

    public function deleteGear($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}