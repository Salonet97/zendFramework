<?php

namespace Frank\Form;

use Zend\Validator\StringLength;
use Zend\Validator\Identical;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\I18n\Validator\Alnum;
use Zend\Mvc\I18n\Translator as TranslatorMvc;
use Zend\I18n\Translator\Translator;
use Zend\Validator\AbstractValidator;

class CatalogoValidator extends InputFilter {

	protected $opcionesStringLength = [
		'min' => 4,
		'max' => 50,
		'messages' => [
			StringLength::TOO_SHORT => "El campo debe tener tener al menos 4 caracteres",
			StringLength::TOO_LONG => "El campo debe tener un máximo de 50 caracteres",
		]
	];
	protected $opcionesAlnum = [
		//con esto acepta espacios en blanco
		'allowWhiteSpace' => true,
		'messages' => [
			'notAlnum' => "El valor  no es alfanúmerico",
		]
	];

	public function __construct() {
		$translator = new TranslatorMvc(new Translator());
		$translator->addTranslationFile('phparray', './module/Frank/language/es_ES.php');
		AbstractValidator::setDefaultTranslator($translator);

		$this->add([
			'name' => 'id',
			'filters' => [
				['name' => 'Int'],
			],
		]);
		
		$this->add([
			'name' => 'costo',
			'filters' => [
				['name' => 'toFloat'],
			],
		]);
		
		$this->add([
			'name' => 'totalhoras',
			'filters' => [
				['name' => 'Int'],
			],
		]);

		$this->add([
			'name' => 'cupolimite',
			'filters' => [
				['name' => 'Int'],
			],
		]);
		
		$titulo = new Input('titulo');
		$titulo->setRequired(true);
		$titulo->getFilterChain()
				->attachByName('StripTags')
				->attachByName('StringTrim');
		$titulo->getValidatorChain()
				//->addValidator(new StringLength($this->opcionesStringLength))
				->addValidator(new Alnum($this->opcionesAlnum));
		$this->add($titulo);		
		
	}

}

?>