<?php

namespace Frank\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Estudiante extends Form {

    public function __construct($name = null) {
        parent::__construct($name);
		
		$this->add([
            'type' => Element\Text::class,
            'name' => 'descripcion',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Descripcion',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);

		$this->add([
			'name' => 'guardar',
			'type' => Element\Submit::class,
			'attributes' => [
				'value' => 'Guardar',
				'class' => 'btn btn-primary',
			],
		]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'codigo',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Codigo',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);
        
        // Crear y configurar el elemento username: 
        $this->add([
            'type' => Element\Text::class,
            'name' => 'username',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Username',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);

        // Crear y configurar el elemento direccion:
        $this->add([
            'type' => Element\Text::class,
            'name' => 'direccion',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Dirección',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);

        // Crear y configurar el elemento password:
        $this->add([
            'type' => Element\Password::class,
            'name' => 'password',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Password',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);

        // Crear y configurar el elemento confirmarPassword:
        $this->add([
            'type' => Element\Password::class,
            'name' => 'confirmarPassword',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Confirmar Password',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);

        // Crear y configurar el elemento recibeNewsletter:
        $recibeNewsletter = new Element\Checkbox('recibeNewsletter');
        $recibeNewsletter->setLabel('Suscribirse al newsletter?')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);

        $this->add($recibeNewsletter);

        // Crear y configurar el elemento Temas:
        $listaTemas = new Element\MultiCheckbox('temas');
        $listaTemas->setLabel('Temas favoritos')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);

        $this->add($listaTemas);

        // Crear y configurar el elemento genero:
        $genero = new Element\Radio('genero');
        $genero->setLabel('Genero')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);
        $this->add($genero);

        // Crear y configurar el elemento numero Favorito:
        $numeroFavorito = new Element\Radio('numeroFavorito');
        $numeroFavorito->setLabel('Seleccione un número')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);
        $this->add($numeroFavorito);

        // Crear y configurar el elemento pais:
        $pais = new Element\Select('pais');
        $pais->setLabel('País')
                ->setEmptyOption('Seleccione un país -->')
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);
        $this->add($pais);

        // Crear y configurar el elemento Experiencia Zend:
        $experienciaZend = new Element\Select('experienciaZend');
        $experienciaZend->setLabel('Habilidades en Zend F3')
        ->setAttribute('multiple', true)
                ->setAttribute('class', 'form-control')
                ->setLabelAttributes([
                    'class' => 'col-sm-2 control-label',
        ]);
        $this->add($experienciaZend);

        $valorSecreto = new Element\Hidden('valorSecreto');
        $this->add($valorSecreto);

        $this->add([
            'name' => 'send',
            'type' => Element\Submit::class,
            'attributes' => [
                'value' => 'Crear',
                'class' => 'btn btn-primary',
            ],
        ]);

    }

}
