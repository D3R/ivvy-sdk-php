<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model\Validator;

use Fcds\Ivvy\Model\BusinessRuleException;
use Fcds\Ivvy\Model\Contact;
use Fcds\Ivvy\Model\Validator\UpdateContactValidator;
use Fcds\Ivvy\Model\Validator\Validator;
use Fcds\IvvyTest\BaseTestCase;

/**
 * Class: UpdateContactValidatorTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Model\Validator\UpdateContactValidator
 * @covers Fcds\Ivvy\Model\Contact
 */
final class UpdateContactValidatorTest extends BaseTestCase
{
    /** @var Validator */
    protected $validator;

    public function setUp()
    {
        $this->validator = new UpdateContactValidator();
    }

    public function testSuccessfulValidation()
    {
        $john = new Contact([
            'id' => 100,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'johndoe@mail.com',
            'phone' => '6123-4567',
        ]);

        $mary = new Contact([
            'id' => 200,
            'email' => 'marysue@mail.com',
            'phone' => '234-5678',
        ]);

        $john->validate($this->validator);
        $mary->validate($this->validator);

        $this->assertTrue(true); // Everything is fine
    }

    public function testValidateContactWithNoId()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact;

        $result = $contact->validate($this->validator);
    }

    public function testValidateContactWithNoEmail()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'id' => 100,
        ]);

        $result = $contact->validate($this->validator);
    }

    public function testValidateInvalidEmailAddress()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'id' => 100,
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
            'id' => 100,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'phone' => 'foo',
        ]);

        $contact->validate($this->validator);
    }
}
