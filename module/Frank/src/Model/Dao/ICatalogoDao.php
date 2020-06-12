<?php
namespace Frank\Model\Dao;

use Frank\Model\Entity\Catalogo;

interface ICatalogoDao {

	public function obtenerTodos();

	public function obtenerPorId($id);

	public function guardar(Catalogo $catalogo);

	public function eliminar(Catalogo $catalogo);
}
