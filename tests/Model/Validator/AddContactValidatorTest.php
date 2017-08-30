<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model\Validator;

use Fcds\Ivvy\Model\BusinessRuleException;
use Fcds\Ivvy\Model\Contact;
use Fcds\Ivvy\Model\Validator\AddContactValidator;
use Fcds\Ivvy\Model\Validator\Validator;
use Fcds\IvvyTest\BaseTestCase;

/**
 * Class: AddContactValidatorTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Model\Validator\AddContactValidator
 * @covers Fcds\Ivvy\Model\Contact
 */
final class AddContactValidatorTest extends BaseTestCase
{
    /** @var Validator */
    protected $validator;

    public function setUp()
    {
        $this->validator = new AddContactValidator();
    }

    public function testSuccessfulValidation()
    {
        $john = new Contact([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'phone' => '6123-4567',
        ]);

        $mary = new Contact([
            'firstName' => 'Mary',
            'lastName' => 'Sue',
            'email' => 'marysue@mail.com',
            'phone' => '234-5678',
        ]);

        $john->validate($this->validator);
        $mary->validate($this->validator);

        $this->assertTrue(true); // Everything is fine
    }

    public function testValidateContactWithNoFirstName()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'lastName' => 'Doe',
        ]);

        $contact->validate($this->validator);
    }

    public function testValidateContactWithNoLastName()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'firstName' => 'John',
        ]);

        $contact->validate($this->validator);
    }

    public function testValidateContactHasNoIdSet()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'id' => 100,
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        $contact->validate($this->validator);
    }

    public function testValidateInvalidEmailAddress()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'foo',
        ]);

        $contact->validate($this->validator);
    }

    public function testValidateInvalidPhone()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'phone' => 'foo',
        ]);

        $contact->validate($this->validator);
    }
}
