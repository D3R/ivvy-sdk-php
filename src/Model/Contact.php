<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

use Fcds\Ivvy\Model\Validator\Validatable;

/**
 * Class: Contact
 *
 * @see BaseModel
 *
 * Represents a contact in iVvy.
 * NOTE: Doesn't support Groups yet.
 */
class Contact extends BaseModel implements Validatable
{
    use ValidateTrait;

    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $customFields;
    public $companies;
    public $externalId;
    public $modifiedDate;

    /**
     * Construct a new Contact object
     *
     * keys:
     * <pre>
     * id (integer)
     * firstName (string)
     * lastName (string)
     * email (string)
     * phone (string)
     * customFields (array<CustomField>)
     * </pre>
     *
     * @params array $props
     */
    public function __construct(array $props = [])
    {
        $this->id           = $props['id'] ?? 0;
        $this->firstName    = $props['firstName'] ?? null;
        $this->lastName     = $props['lastName'] ?? null;
        $this->email        = $props['email'] ?? null;
        $this->phone        = $props['phone'] ?? null;
        $this->customFields = $props['customFields'] ?? null;
        $this->companies    = $props['companies'] ?? null;
        $this->externalId   = $props['externalId'] ?? null;
        $this->modifiedDate = $props['modifiedDate'] ?? null;
    }
}
