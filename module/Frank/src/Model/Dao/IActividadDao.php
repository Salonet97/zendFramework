<?php

namespace Frank\Model\Dao;

use Frank\Model\Entity\Actividad;

interface IActividadDao {

	public function obtenerTodos();

	public function obtenerPorId($id);

	public function guardar(Actividad $actividad);

	public function eliminar(Actividad $actividad);
	
}

?>