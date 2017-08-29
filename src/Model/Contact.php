<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

/**
 * Class: Contact
 *
 * @see BaseModel
 *
 * Represents a contact in iVvy.
 * NOTE: Doesn't support Groups yet.
 */
class Contact extends BaseModel
{
    use ValidateTrait;

    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $customFields;

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
        foreach ($props as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
