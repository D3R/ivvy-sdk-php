<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\JobFactory;
use Fcds\Ivvy\Model\Company;
use Fcds\Ivvy\Model\Contact;
use InvalidArgumentException;

/**
 * Class: JobFactoryTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\JobFactory
 */
final class JobFactoryTest extends BaseTestCase
{
    /** @var JobFactory */
    protected $factory;

    public function setUp()
    {
        $this->factory = new JobFactory;
    }

    public function testCanCreatePingJob()
    {
        $expectedArray = [
            'namespace' => 'test',
            'action' => 'ping',
            'params' => [],
        ];

        $pingJob = $this->factory->newPingJob();

        $this->assertArraySubset($expectedArray, $pingJob->toArray());
    }

    public function testCanCreateAddCompanyJob()
    {
        $expectedArray = [
            'namespace' => 'contact', // see page 28 and 29 from the API PDF.
            'action' => 'addOrUpdateCompany',
            'params' => [
                'businessName' => 'Acme',
            ],
        ];

        $company = new Company([
            'businessName' => 'Acme',
            'phone' => '+18888888',
        ]);

        $result = $this->factory->newAddCompanyJob($company);

        $this->assertArraySubset($expectedArray, $result->toArray());
    }

    public function testWillNotCreateAddCompanyJobWithNoBusinessName()
    {
        $this->expectException(InvalidArgumentException::class);

        $company = new Company([
            'phone' => '+18888888',
        ]);

        $this->factory->newAddCompanyJob($company);
    }

    public function testWillNotCreateAddCompanyJobWithAnId()
    {
        $this->expectException(InvalidArgumentException::class);

        $company = new Company([
            'id' => 100,
            'businessName' => 'Acme',
        ]);

        $this->factory->newAddCompanyJob($company);
    }

    public function testCanCreateUpdateCompanyJob()
    {
        $expectedArray = [
            'namespace' => 'contact', // see page 28 and 29 from the API PDF.
            'action' => 'addOrUpdateCompany',
            'params' => [
                'id' => 100,
            ],
        ];

        $company = new Company([
            'id' => 100,
            'businessName' => 'Acme',
        ]);

        $result = $this->factory->newUpdateCompanyJob($company);

        $this->assertArraySubset($expectedArray, $result->toArray());
    }

    public function testWillNotCreateUpdateCompanyJobWithNoId()
    {
        $this->expectException(InvalidArgumentException::class);

        $company = new Company([
            'businessName' => 'Acme',
        ]);

        $this->factory->newUpdateCompanyJob($company);
    }

    public function testCanCreateAddContactJob()
    {
        $expectedArray = [
            'namespace' => 'contact',
            'action' => 'addOrUpdateContact',
            'params' => [
                'firstName' => 'John',
                'lastName' => 'Doe',
            ],
        ];

        $contact = new Contact([
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        $result = $this->factory->newAddContactJob($contact);

        $this->assertArraySubset($expectedArray, $result->toArray());
    }

    public function testWillNotCreateAddContactJobWithNoFirstNameOrLastName()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->factory->newAddContactJob(new Contact);
    }

    public function testWillNotCreateAddContactJobWithAnId()
    {
        $this->expectException(InvalidArgumentException::class);

        $contact = new Contact([
            'id' => 100,
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        $this->factory->newAddContactJob($contact);
    }
}
