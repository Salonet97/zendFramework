<?php

namespace Frank\Model\Dao;
use Frank\Model\Entity\Producto;

/**
 *
 * @author Andres
 */
interface IProductoDao {

    public function obtenerTodos();

    public function obtenerPorId($id);

    public function guardar(Producto $producto);

    public function eliminar(Producto $producto);
}

