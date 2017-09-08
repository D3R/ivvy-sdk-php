<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

/**
 * Class: CustomField
 *
 * @see BaseModel
 */
class CustomField extends BaseModel
{
    public $fieldId;
    public $displayName;
    public $value;

    /**
     * Construct a new CustomField object
     */
    public function __construct(string $fieldId, string $displayName, string $value)
    {
        $this->fieldId     = $fieldId;
        $this->displayName = $displayName;
        $this->value       = $value;
    }
}
