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
        $this->id = $props['id'] ?? 0;
        $this->businessName = $props['businessName'] ?? null;
        $this->externalId = $props['externalId'] ?? 0;
        $this->tradingName = $props['tradingName'] ?? null;
        $this->businessNumber = $props['businessNumber'] ?? null;
        $this->phone = $props['phone'] ?? null;
        $this->fax = $props['fax'] ?? null;
        $this->website = $props['website'] ?? null;
        $this->email = $props['email'] ?? null;
        $this->address = $props['address'] ?? null;
    }
}
