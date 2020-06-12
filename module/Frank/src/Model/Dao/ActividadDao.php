<?php
namespace Frank\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Frank\Model\Entity\Actividad;
use RuntimeException;

class ActividadDao implements IActividadDao {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function obtenerPorId($id) {
        $rowset = $this->tableGateway->select(['id' => (int)$id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException("No se pudo encontrar la actividad: $id");
        }
        return $row;
    }

	//regresa un objeto de tipo Arreglo de Producto, un objeto de colección, 
	//que nos permitirá interactuar con los registros obtenidos en el template 
	//de nuestro archivo vista phtml:
    public function obtenerTodos() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function eliminar(Actividad $actividad) {
        $this->tableGateway->delete(['id' => $actividad->getId()]);
    }

    public function guardar(Actividad $actividad) {
        $data = [
            'descripcion' => $actividad->getDescripcion(),
        ];

        $id = (int) $actividad->getId();

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->obtenerPorId($id)) {
                $this->tableGateway->update($data, ['id' => $id]);
            } else {
                throw new RuntimeException("Id de la Actividad no existe: $id");
            }
        }
    }

}