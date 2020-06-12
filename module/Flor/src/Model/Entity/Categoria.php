<?php

namespace Flor\Model\Entity;

class Categoria {

    
	private $descripcion;
    private $id;

    public function __construct($descripcion= null , $id= null) {
        $this->descripcion = $descripcion;
        $this->id = $id;
		
    }
	
	public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

	//con este metodo se mandan los datos del formulario a la vista de registrar
    public function exchangeArray($data) {
		$this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

