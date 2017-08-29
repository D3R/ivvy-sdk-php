<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\JobFactory;

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
}
