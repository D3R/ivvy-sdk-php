<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model\Validator;

/**
 * Abstracts the mixin for process business rules implementation as it works on
 * generic objects.
 */
trait ProcessBusinessRuleTrait
{
    /**
     * @{inheritDocs}
     */
    public function processBusinessRules($genericObject): array
    {
        return array_filter(iterator_to_array($this->process($genericObject)));
    }
}
