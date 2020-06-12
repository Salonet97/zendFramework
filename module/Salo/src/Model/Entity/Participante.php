<?php

namespace Salo\Model\Entity;

class Participante {

    private $nombre;
    private $curp;
    private $procedencia;
    private $cuenta;
    private $password;
    private $confirmarPassword;
    

    public function __construct($nombre = null, $curp = null, $procedencia=null,$cuenta=null, $password = null, $confirmarPassword = null) {
        $this->nombre = $nombre;
        $this->curp = $curp;
        $this->procedencia = $procedencia;
        $this->cuenta = $cuenta;
        $this->password = $password;
        $this->confirmarPassword = $confirmarPassword;
        
		
    }
	
	public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getCurp() {
        return $this->curp;
    }

    public function setCurp($curp) {
        $this->curp = $curp;
    }

    public function getProcedencia() {
        return $this->procedencia;
    }

    public function setProcedencia($procedencia) {
        $this->procedencia = $procedencia;
    }
    
    public function getCuenta() {
        return $this->cuenta;
    }

    public function setCuenta($cuenta) {
        $this->cuenta = $cuenta;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getConfirmarPassword() {
        return $this->confirmarPassword;
    }

    public function setConfirmarPassword($confirmarPassword) {
        $this->confirmarPassword = $confirmarPassword;
    }

    

	//con este metodo se mandan los datos del formulario a la vista de registrar
    public function exchangeArray($data) {
		$this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
        $this->curp = (isset($data['curp'])) ? $data['curp'] : null;
        $this->procedencia = (isset($data['procedencia'])) ? $data['procedencia'] : null;
        $this->cuenta = (isset($data['cuenta'])) ? $data['cuenta'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
                
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

