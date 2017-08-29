<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

use Fcds\Ivvy\Model\Validator\Validator;

/**
 * Abstracts the mixin for validate implementation as it works on
 * generic objects.
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
