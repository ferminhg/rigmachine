<?php
namespace Artistband\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class ArtistbandTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        //TODO hacer merge con las tablas pertinentes
        $resultSet = $this->tableGateway->select(function (Select $select) {
                //$select->order('name ASC');
        });
        return $resultSet;
    }

    public function getArtistband($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveArtistband(Artistband $artistband)
    {
        $data = array(
            'name' => $artistband->name,
            'artist_id' => $artistband->artist_id,
            'band_id' => $artistband->band_id,
            'inicio' => $artistband->inicio,
            'fin' => $artistband->fin,
            'info' => $artistband->info,
        );

        $id = (int)$artistband->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getArtistband($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteArtistband($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}