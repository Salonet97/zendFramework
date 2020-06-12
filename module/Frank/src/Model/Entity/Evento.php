<?php

namespace Frank\Model\Entity;

class Evento{
	
	private $id;
	private $titulo;
	private $descripcion;
	private $fechainicio;
	private $fechafin;
	private $observaciones;
	private $logotipo;
	private $eslogan;
	private $lugar;
	private $categoria_id;
	private $inicioregistro;
	private $cierreregistro;
	private $organizador_id;
	
	function getId() {
		return $this->id;
	}

	function getTitulo() {
		return $this->titulo;
	}

	function getDescripcion() {
		return $this->descripcion;
	}

	function getFechainicio() {
		return $this->fechainicio;
	}

	function getFechafin() {
		return $this->fechafin;
	}

	function getObservaciones() {
		return $this->observaciones;
	}

	function getLogotipo() {
		return $this->logotipo;
	}

	function getEslogan() {
		return $this->eslogan;
	}

	function getLugar() {
		return $this->lugar;
	}

	function getCategoria_id() {
		return $this->categoria_id;
	}

	function getInicioregistro() {
		return $this->inicioregistro;
	}

	function getCierreregistro() {
		return $this->cierreregistro;
	}

	function getOrganizador_id() {
		return $this->organizador_id;
	}

	function setId($id): void {
		$this->id = $id;
	}

	function setTitulo($titulo): void {
		$this->titulo = $titulo;
	}

	function setDescripcion($descripcion): void {
		$this->descripcion = $descripcion;
	}

	function setFechainicio($fechainicio): void {
		$this->fechainicio = $fechainicio;
	}

	function setFechafin($fechafin): void {
		$this->fechafin = $fechafin;
	}

	function setObservaciones($observaciones): void {
		$this->observaciones = $observaciones;
	}

	function setLogotipo($logotipo): void {
		$this->logotipo = $logotipo;
	}

	function setEslogan($eslogan): void {
		$this->eslogan = $eslogan;
	}

	function setLugar($lugar): void {
		$this->lugar = $lugar;
	}

	function setCategoria_id($categoria_id): void {
		$this->categoria_id = $categoria_id;
	}

	function setInicioregistro($inicioregistro): void {
		$this->inicioregistro = $inicioregistro;
	}

	function setCierreregistro($cierreregistro): void {
		$this->cierreregistro = $cierreregistro;
	}

	function setOrganizador_id($organizador_id): void {
		$this->organizador_id = $organizador_id;
	}

	public function exchangeArray($data){
		$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->titulo = (isset($data['titulo'])) ? $data['titulo'] : null;
		$this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
		$this->fechainicio = (isset($data['fechainicio'])) ? $data['fechainicio'] : null;
		$this->fechafin = (isset($data['fechafin'])) ? $data['fechafin'] : null;
		$this->observaciones = (isset($data['observaciones'])) ? $data['observaciones'] : null;
		$this->logotipo = (isset($data['logotipo'])) ? $data['logotipo'] : null;
		$this->eslogan = (isset($data['eslogan'])) ? $data['eslogan'] : null;
		$this->lugar = (isset($data['lugar'])) ? $data['lugar'] : null;
		$this->categoria_id = (isset($data['categoria_id'])) ? $data['categoria_id'] : null;
		$this->inicioregistro = (isset($data['inicioregistro'])) ? $data['inicioregistro'] : null;
		$this->cierreregistro = (isset($data['cierreregistro'])) ? $data['cierreregistro'] : null;
		$this->organizador_id = (isset($data['organizador_id'])) ? $data['organizador_id'] : null;
	}
	
	public function getArrayCopy(){
		return get_object_vars($this);
	}
}