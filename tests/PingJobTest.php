<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\PingJob;
use Fcds\IvvyTest\BaseTestCase;

/**
 * Class: PingJobTest
 *
 * @see BaseTestCase
 * @covers Fcds\Ivvy\PingJob
 */
final class PingJobTest extends BaseTestCase
{
    /** @var PingJob */
    protected $pingJob;

    public function setUp()
    {
        $this->pingJob = new PingJob;
    }

    public function testHasCorrectDefinition()
    {
        $expectedArray = [
            'namespace' => 'test',
            'action' => 'ping',
            'params' => [],
        ];

        $result = $this->pingJob->toArray();

        $this->assertArraySubset($expectedArray, $result);
    }
}
