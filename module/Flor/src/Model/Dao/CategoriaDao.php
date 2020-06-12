<?php
namespace Flor\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Flor\Model\Entity\Categoria;
use RuntimeException;

class CategoriaDao implements ICategoriaDao {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function obtenerPorId($id) {
        $rowset = $this->tableGateway->select(['id' => (int)$id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException("No se pudo encontrar la categoria: $id");
        }
        return $row;
    }

	//regresa un objeto de tipo Arreglo de categoria, un objeto de colección, 
	//que nos permitirá interactuar con los registros obtenidos en el template 
	//de nuestro archivo vista phtml:
    public function obtenerTodos() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function eliminar(Categoria $categoria) {
        $this->tableGateway->delete(['id' => $categoria->getId()]);
    }

    public function guardar(Categoria $categoria) {
        $data = [
            'descripcion' => $categoria->getDescripcion(),
        ];

        $id = (int) $categoria->getId();

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->obtenerPorId($id)) {
                $this->tableGateway->update($data, ['id' => $id]);
            } else {
                throw new RuntimeException("Id de la Categoria no existe: $id");
            }
        }
    }

}