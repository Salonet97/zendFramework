<?php

namespace Flor\Model\Dao;

use Flor\Model\Entity\Categoria;

interface ICategoriaDao {

	public function obtenerTodos();

	public function obtenerPorId($id);

	public function guardar(Categoria $categoria);

	public function eliminar(Categoria $categoria);
	
}

?>