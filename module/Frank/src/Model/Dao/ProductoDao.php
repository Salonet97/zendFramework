<?php

namespace Frank\Model\Dao;

use Zend\Db\TableGateway\TableGateway;
use Frank\Model\Entity\Producto;
use RuntimeException;

/**
 * Description of ProductoDao
 *
 * @author Andres
 */
class ProductoDao implements IProductoDao {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function obtenerPorId($id) {
        $rowset = $this->tableGateway->select(['id' => (int)$id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException("No se pudo encontrar el Producto: $id");
        }
        return $row;
    }

    public function obtenerTodos() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function eliminar(Producto $producto) {
        $this->tableGateway->delete(['id' => $producto->getId()]);
    }

    public function guardar(Producto $producto) {
        $data = [
            'descripcion' => $producto->getDescripcion(),
            'cantidad' => $producto->getCantidad(),
            'precio' => $producto->getPrecio(),
        ];

        $id = (int) $producto->getId();

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->obtenerPorId($id)) {
                $this->tableGateway->update($data, ['id' => $id]);
            } else {
                throw new RuntimeException("Id del Producto no existe: $id");
            }
        }
    }

}

