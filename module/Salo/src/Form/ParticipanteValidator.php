<?php

namespace Salo\Form;

use Zend\Validator\StringLength;
use Zend\Validator\Identical;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\I18n\Validator\Alnum;


use Zend\Mvc\I18n\Translator as TranslatorMvc;
use Zend\I18n\Translator\Translator;
use Zend\Validator\AbstractValidator;


/**
 * Description of EstudianteValidator
 *
 * @author Andres
 */
class ParticipanteValidator extends InputFilter {

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
        $translator->addTranslationFile('phparray', './module/Salo/language/es_ES.php');
        AbstractValidator::setDefaultTranslator($translator);

		/*
        $this->add([
            'name' => 'codigo',
            'validators' => [
                [
                    'name' => Validator\CodigoValidador::class,
                ],
            ],
        ]);
		*/
		 
		
		//validación del set nombre
        $nombre = new Input('nombre');
		//con esto obliga al usuario a que se llene este campo
        $nombre->setRequired(true);
        $nombre->getFilterChain()
				//quita etiquetas html y javascript
                ->attachByName('StripTags')
				//quita espacios en blanco
                ->attachByName('StringTrim');

		//agregamos validadores
        $nombre->getValidatorChain()
				//
                ->addValidator(new StringLength($this->opcionesStringLength))
				//validador alfanumerico
                ->addValidator(new Alnum($this->opcionesAlnum));
		$this->add($nombre);

        $curp = new Input('curp');
        $curp->setRequired(true);
        $curp->getValidatorChain()
                ->addValidator(new Alnum($this->opcionesAlnum));
        $this->add($curp);

        $procedencia = new Input('procedencia');
        $procedencia->setRequired(true);
        $procedencia->getValidatorChain()
                ->addValidator(new Alnum($this->opcionesAlnum));
        $this->add($procedencia);

        $cuenta = new Input('cuenta');
        $cuenta->setRequired(true);
        $cuenta->getValidatorChain()
                ->addValidator(new Alnum($this->opcionesAlnum));
        $this->add($cuenta);

        $password = new Input('password');
        $password->setRequired(true);
        $password->getValidatorChain()
                ->addValidator(new StringLength($this->opcionesStringLength))
                ->addValidator(new Alnum($this->opcionesAlnum));
        $this->add($password);

        $confirmarPassword = new Input('confirmarPassword');
        $confirmarPassword->setRequired(true);
        $confirmarPassword->getValidatorChain()
                ->addValidator(new StringLength($this->opcionesStringLength))
                ->addValidator(new Alnum($this->opcionesAlnum))
                ->addValidator(new Identical(
                        [
                    'token' => 'password',
                    'messages' => [
                        'notSame' => "Las contraseñas no coinciden, por favor intente de nuevo",
                    ]
                        ]
        ));

        $this->add($confirmarPassword);

        
    }

}
?>