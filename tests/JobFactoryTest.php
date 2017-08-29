<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\JobFactory;
use Fcds\Ivvy\Model\Company;
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
}
