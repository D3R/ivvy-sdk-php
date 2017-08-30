<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model\Validator;

use Fcds\Ivvy\Model\BusinessRuleException;

/**
 * Interface: Validatable
 *
 * Represents a business object that can be validated
 */
interface Validatable
{
    /**
     * @throws BusinessRuleException
     */
    public function validate(Validator $validator);
}
