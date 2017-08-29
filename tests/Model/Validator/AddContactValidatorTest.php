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

    public function testValidateContactWithNoFirstName()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'lastName' => 'Doe',
        ]);

        $result = $contact->validate($this->validator);
    }

    public function testValidateContactWithNoLastName()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'firstName' => 'John',
        ]);

        $result = $contact->validate($this->validator);
    }

    public function testValidateContactHasNoIdSet()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact([
            'id' => 100,
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        $result = $contact->validate($this->validator);
    }
}
