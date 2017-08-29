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

    public function testValidateContactHasId()
    {
        $contact = new Contact([
            'id' => 100,
        ]);

        $result = $contact->validate($this->validator);

        $this->assertTrue(true); // nothing bad happened
    }

    public function testValidateContactWithNoId()
    {
        $this->expectException(BusinessRuleException::class);

        $contact = new Contact;

        $result = $contact->validate($this->validator);
    }
}
