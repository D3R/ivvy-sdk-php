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
    public $value;

    /**
     * Construct a new CustomField object
     *
     * keys:
     * <pre>
     * fieldId (integer)
     * value (string)
     * </pre>
     *
     * @param array $props
     */
    public function __construct(array $props = [])
    {
        foreach ($props as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
