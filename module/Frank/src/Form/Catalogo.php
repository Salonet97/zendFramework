<?php

namespace Frank\Form;

use Zend\Form\Form;
use Zend\Form\Element;

Class Catalogo extends Form {

	public function __construct($name = null) {
		parent::__construct($name);

		$this->add([
			'type' => Element\Select::class,
			'name' => 'actividad',
			'attributes' => [
				'class' => 'form-control',
			],
			'options' => [
				'label' => 'Actividad',
				'empty_option' => 'Seleccione una actividad =>',
				'label_attributes' => [
					'class' => 'col-sm-2 control-label',
				],
			],
		]);
		
		$this->add([
			'type' => Element\Select::class,
			'name' => 'evento',
			'attributes' => [
				'class' => 'form-control',
			],
			'options' => [
				'label' => 'Evento',
				'empty_option' => 'Seleccione un Evento =>',
				'label_attributes' => [
					'class' => 'col-sm-2 control-label',
				],
			],
		]);

		$this->add([
			'type' => Element\Text::class,
			'name' => 'titulo',
			'attributes' => [
				'class' => 'form-control',
			],
			'options' => [
				'label' => 'Titulo',
				'label_attributes' => [
					'class' => 'col-sm-2 control-label',
				],
			],
		]);

		$this->add([
			'type' => Element\Text::class,
			'name' => 'costo',
			'attributes' => [
				'class' => 'form-control',
			],
			'options' => [
				'label' => 'Costo',
				'label_attributes' => [
					'class' => 'col-sm-2 control-label',
				],
			]
		]);

		$this->add([
			'type' => Element\Text::class,
			'name' => 'totalhoras',
			'attributes' => [
				'class' => 'form-control',
			],
			'options' => [
				'label' => 'Total de Horas',
				'label_attributes' => [
					'class' => 'col-sm-2 control-label',
				],
			]
		]);

		$this->add([
			'type' => Element\Text::class,
			'name' => 'cupolimite',
			'attributes' => [
				'class' => 'form-control',
			],
			'options' => [
				'label' => 'Limite de Cupo',
				'label_attributes' => [
					'class' => 'col-sm-2 control-label',
				],
			]
		]);

		$this->add([
			'name' => 'id',
			'type' => Element\Hidden::class,
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