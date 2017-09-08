<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model;

use Fcds\Ivvy\Model\Contact;
use Fcds\IvvyTest\BaseTestCase;
use Fcds\Ivvy\Model\CustomField;

/**
 * Class: ContactTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Model\Contact
 */
class ContactTest extends BaseTestCase
{
    public function testInstantiateWithArguments()
    {
        $contact = new Contact([
            'id'           => 100,
            'firstName'    => 'foo',
            'lastName'     => 'bar',
            'email'        => 'foo@mail.com',
            'phone'        => '+8 888 888',
            'customFields' => [new CustomField('baz', 'qux', 'corge')],
        ]);

        $this->assertEquals(100, $contact->id);
        $this->assertEquals('foo', $contact->firstName);
        $this->assertEquals('bar', $contact->lastName);
        $this->assertEquals('foo@mail.com', $contact->email);
        $this->assertEquals('+8 888 888', $contact->phone);
        $this->assertEquals('baz', $contact->customFields[0]->fieldId);
    }

    public function testInstantiateWithDefaultValues()
    {
        $contact = new Contact;

        $this->assertEquals(0, $contact->id);
        $this->assertEquals(null, $contact->firstName);
        $this->assertEquals(null, $contact->lastName);
        $this->assertEquals(null, $contact->email);
        $this->assertEquals(null, $contact->phone);
        $this->assertEquals(null, $contact->customFields);
    }
}
