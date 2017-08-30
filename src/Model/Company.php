<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

use Fcds\Ivvy\Model\Validator\Validatable;

class Company extends BaseModel implements Validatable
{
    use ValidateTrait;

    public $id;
    public $businessName;
    public $externalId;
    public $tradingName;
    public $businessNumber;
    public $phone;
    public $fax;
    public $website;
    public $email;
    public $address;

    /**
     * Construct a new Company object
     *
     * keys:
     * <pre>
     * id (integer)
     * businessName (string)
     * externalId (string)
     * tradingName (string)
     * businessNumber (string)
     * phone (string)
     * fax (string)
     * website (String)
     * email (string)
     * address (Address)
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

        // TODO: write it with this approach:
        /* $this->id = $props['id'] ?? 0; */
    }
}
