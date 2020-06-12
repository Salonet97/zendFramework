<?php

namespace Frank\Model\Entity;

class Estudiante {

    private $username;
    private $direccion;
    private $password;
    private $confirmarPassword;
    private $recibeNewsletter = false;
    private $temas = array();
    private $numeroFavorito = 0;
    private $genero;
    private $pais;
    private $experienciaZend = array();
    //valor oculto
    private $valorSecreto;

    public function __construct($username = null, $direccion = null, $password = null, $genero = null) {
        $this->username = $username;
        $this->direccion = $direccion;
        $this->password = $password;
        $this->genero = $genero;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
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

    public function getRecibeNewsletter() {
        return $this->recibeNewsletter;
    }

    public function setRecibeNewsletter($recibeNewsletter) {
        $this->recibeNewsletter = $recibeNewsletter;
    }

    public function getTemas() {
        return $this->temas;
    }

    public function setTemas(array $temas) {
        $this->temas = $temas;
    }

    public function getNumeroFavorito() {
        return $this->numeroFavorito;
    }

    public function setNumeroFavorito($numeroFavorito) {
        $this->numeroFavorito = $numeroFavorito;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function getPais() {
        return $this->pais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function getExperienciaZend() {
        return $this->experienciaZend;
    }

    public function setExperienciaZend(array $experienciaZend) {
        $this->experienciaZend = $experienciaZend;
    }

    public function getValorSecreto() {
        return $this->valorSecreto;
    }

    public function setValorSecreto($valorSecreto) {
        $this->valorSecreto = $valorSecreto;
    }

    public function exchangeArray($data) {
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->direccion = (isset($data['direccion'])) ? $data['direccion'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->confirmarPassword = (isset($data['confirmarPassword'])) ? $data['confirmarPassword'] : null;
        $this->recibeNewsletter = (isset($data['recibeNewsletter'])) ? $data['recibeNewsletter'] : null;
        $this->temas = (isset($data['temas'])) ? $data['temas'] : null;
        $this->numeroFavorito = (isset($data['numeroFavorito'])) ? $data['numeroFavorito'] : null;
        $this->genero = (isset($data['genero'])) ? $data['genero'] : null;
        $this->pais = (isset($data['pais'])) ? $data['pais'] : null;
        $this->experienciaZend = (isset($data['experienciaZend'])) ? $data['experienciaZend'] : null;
        $this->valorSecreto = (isset($data['valorSecreto'])) ? $data['valorSecreto'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

