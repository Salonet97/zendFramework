<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Flor\Form\Validator;

use Zend\Validator\AbstractValidator;

class CodigoValidador extends AbstractValidator
{

    const INVALID      = 'codigoInvalid';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $messageTemplates = [
        self::INVALID      => "El codigo debe ser válido, ejemplo(12345-B)",
    ];

    /**
     * Returns true if and only if $value only contains digit characters
     *
     * @param  string $value
     * @return bool
     */
    public function isValid($value)
    {
        if ($value !== '12345-B') {
            $this->error(self::INVALID);
            return false;
        }

        return true;
    }
}
