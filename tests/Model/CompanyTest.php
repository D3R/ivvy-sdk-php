<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model;

use Fcds\Ivvy\Model\Company;
use Fcds\IvvyTest\BaseTestCase;
use Fcds\Ivvy\Model\Address;

/**
 * Class: CompanyTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Model\Company
 */
class CompanyTest extends BaseTestCase
{
    public function testInstantiateWithArguments()
    {
        $address = new Address;
        $company = new Company([
            'id' => 100,
            'businessName' => 'foo',
            'externalId' => 200,
            'tradingName' => 'bar',
            'businessNumber' => 'baz',
            'phone' => '+888 888 888',
            'fax' => '+999 999 999',
            'website' => 'qux.com',
            'email' => 'quux@mail.com',
            'address' => $address,
            'modifiedDate' => '2017-10-27 22:28:08 UTC'
        ]);

        $this->assertEquals(100, $company->id);
        $this->assertEquals('foo', $company->businessName);
        $this->assertEquals(200, $company->externalId);
        $this->assertEquals('bar', $company->tradingName);
        $this->assertEquals('baz', $company->businessNumber);
        $this->assertEquals('+888 888 888', $company->phone);
        $this->assertEquals('+999 999 999', $company->fax);
        $this->assertEquals('quux@mail.com', $company->email);
        $this->assertEquals($address, $company->address);
        $this->assertEquals('2017-10-27 22:28:08 UTC', $company->modifiedDate);
    }

    public function testInstantiateWithDefaultValues()
    {
        $company = new Company;

        $this->assertEquals(0, $company->id);
        $this->assertNull($company->businessName);
        $this->assertEquals(0, $company->externalId);
        $this->assertNull($company->tradingName);
        $this->assertNull($company->businessNumber);
        $this->assertNull($company->phone);
        $this->assertNull($company->fax);
        $this->assertNull($company->email);
        $this->assertNull($company->address);
        $this->assertNull($company->modifiedDate);
    }
}
