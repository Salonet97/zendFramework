<?php

namespace Flor\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Categoria extends Form {

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
			'name' => 'id',
			'type' => Element\Hidden::class,
		]);
	}

}
?>