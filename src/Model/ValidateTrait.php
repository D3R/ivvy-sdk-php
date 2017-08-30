<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

use Fcds\Ivvy\Model\Validator\Validator;

/**
 * Abstracts the mixin for Validatable implementation as it works on
 * generic objects.
 *
 * A class that uses this trait should implement interface
 * `Fcds\Ivvy\Model\Validator\Validatable`
 */
trait ValidateTrait
{
    /**
     * @{inheritDocs}
     */
    public function validate(Validator $validator): void
    {
        $brokenRules = $validator->processBusinessRules($this);

        if (! empty($brokenRules)) {
            throw new BusinessRuleException(array_pop($brokenRules));
        }
    }
}
