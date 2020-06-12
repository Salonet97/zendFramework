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

/**
 * Description of EstudianteValidator
 *
 * @author Andres
 */
class EstudianteValidator extends InputFilter {

	//valida el tamaño
    protected $opcionesStringLength = [
        'min' => 4,
        'max' => 12,
        'messages' => [
            StringLength::TOO_SHORT => "El campo debe tener tener al menos 4 caracteres",
            StringLength::TOO_LONG => "El campo debe tener un máximo de 12 caracteres",
        ]
    ];
    protected $opcionesAlnum = [
        'allowWhiteSpace' => true,
        'messages' => [
            'notAlnum' => "El valor no es alfanúmerico",
        ]
    ];

    public function __construct() {

		//traduce los errores
        $translator = new TranslatorMvc(new Translator());
		//agrega el archivo de traducción
        $translator->addTranslationFile('phparray', './module/Frank/language/es_ES.php');
        //ingresamos los valores por setDefaultTranslator
		AbstractValidator::setDefaultTranslator($translator);

		//
        $this->add([
            'name' => 'codigo',
            'validators' => [
                [
                    'name' => Validator\CodigoValidador::class,
                ],
            ],
        ]);

        $username = new Input('username');
        $username->setRequired(true);
        $username->getFilterChain()
                ->attachByName('StripTags')
                ->attachByName('StringTrim');

        $username->getValidatorChain()
                ->addValidator(new StringLength($this->opcionesStringLength))
                ->addValidator(new Alnum($this->opcionesAlnum));

        $this->add($username);

        $direccion = new Input('direccion');
        $direccion->setRequired(true);
        $direccion->getValidatorChain()
                ->addValidator(new Alnum($this->opcionesAlnum));
        $this->add($direccion);

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


        $this->add([
            'required' => true,
            'name' => 'temas',
        ]);

        $this->add([
            'required' => true,
            'name' => 'numeroFavorito',
        ]);

        $this->add([
            'required' => true,
            'name' => 'pais',
        ]);

        $this->add([
            'required' => true,
            'name' => 'experienciaZend',
        ]);
    }

}
