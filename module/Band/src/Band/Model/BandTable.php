<?php
namespace Band\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class BandTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select(function (Select $select) {
                $select->order('name ASC');
        });
        return $resultSet;
    }

    public function getBand($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveBand(Band $band)
    {
        $data = array(
            'name' => $band->name,
            'website' => $band->website,
            'info' => $band->info,
        );

        $id = (int)$band->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getBand($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteBand($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}