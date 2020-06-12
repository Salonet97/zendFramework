<?php

namespace Salo\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Actividad extends Form {

	public function __construct($name = null) {
		parent::__construct($name);

		$this->add([
			'type' => Element\Text::class,
			'name' => 'nombre',
			'attributes' => [
				'class' => 'form-control',
			],
			'options' => [
				'label' => 'Nombre',
				'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
			],
		]);

		$this->add([
            'type' => Element\Text::class,
            'name' => 'curp',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'curp',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'procedencia',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'institucion de procedencia',
                'label_attributes' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'cuenta',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Cuenta',
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


		$this->add([
			'name' => 'guardar',
			'type' => Element\Submit::class,
			'attributes' => [
				'value' => 'Guardar',
				'class' => 'btn btn-primary',
			],
		]);
	}

}
?>