<?php

namespace Frank\Model\Entity;

class Catalogo {

	private $id;
	private $titulo;
	private $costo;
	private $totalhoras;
	private $cupolimite;
	
	private $actividad;
	private $evento;
	
	public function getActividad() {
		return $this->actividad;
	}

	public function getEvento() {
		return $this->evento;
	}

	public function setActividad($actividad) {
		$this->actividad = $actividad;
	}

	public function setEvento($evento) {
		$this->evento = $evento;
	}

		
	public function getActividad_id() {
		return $this->actividad_id;
	}

	public function getEvento_id() {
		return $this->evento_id;
	}

	function setActividad_id($actividad_id){
		$this->actividad_id = $actividad_id;
	}

	function setEvento_id($evento_id){
		$this->evento_id = $evento_id;
	}

		private $actividad_id;
	private $evento_id;

	public function getId() {
		return $this->id;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function getCosto() {
		return $this->costo;
	}

	public function getTotalhoras() {
		return $this->totalhoras;
	}

	public function getCupolimite() {
		return $this->cupolimite;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	public function setCosto($costo) {
		$this->costo = $costo;
	}

	public function setTotalhoras($totalhoras) {
		$this->totalhoras = $totalhoras;
	}

	public function setCupolimite($cupolimite) {
		$this->cupolimite = $cupolimite;
	}
	
	
	

	
	public function exchangeArray($data) {
		$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->titulo = (isset($data['titulo'])) ? $data['titulo'] : null;
		$this->costo = (isset($data['costo'])) ? $data['costo'] : null;
		$this->totalhoras = (isset($data['totalhoras'])) ? $data['totalhoras'] : null;
		$this->cupolimite = (isset($data['cupolimite'])) ? $data['cupolimite'] : null;
		
		//esto se usan para registrar entradas
		$this->evento_id=(isset($data['evento_id'])) ? $data['evento_id'] : null;
		$this->actividad_id=(isset($data['actividad_id'])) ? $data['actividad_id'] : null;
		
		//con esto jalamos los datos al index
		$this->evento= (isset($data['eventoTitulo'])) ? $data['eventoTitulo'] : null;
		$this->actividad=(isset($data['actividadDescripcion'])) ? $data['actividadDescripcion'] : null;
}
		 

	public function getArrayCopy() {
		return get_object_vars($this);
	}

}
