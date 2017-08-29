<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

class Address extends BaseModel
{
    public $line1;
    public $line2;
    public $stateCode;
    public $postalCode;
    public $countryCode;

    /**
     * Construct a new Address object
     *
     * keys:
     * <pre>
     * line1 (string)
     * line2 (string)
     * stateCode (string)
     * postalCode (string)
     * countryCode (string)
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
