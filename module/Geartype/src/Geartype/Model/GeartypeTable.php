<?php
namespace Geartype\Model;

use Zend\Db\TableGateway\TableGateway;

class GeartypeTable
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

    public function getGeartype($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveGeartype(Geartype $geartype)
    {
        $data = array(
            'name' => $geartype->name,
        );

        $id = (int)$geartype->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getGearType($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteGeartype($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}