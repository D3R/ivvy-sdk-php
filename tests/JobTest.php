<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\Job;
use Fcds\IvvyTest\BaseTestCase;

/**
 * Class: JobTest
 *
 * @see BaseTestCase
 * @covers Fcds\Ivvy\Job
 */
final class JobTest extends BaseTestCase
{
    /** @var Job */
    protected $job;

    public function setUp()
    {
        $this->job = new Job('foo', 'bar', ['baz' => 'qux']);
    }

    public function testCanBeConvertedToArray()
    {
        $expectedArray = [
            'namespace' => 'foo',
            'action' => 'bar',
            'params' => ['baz' => 'qux'],
        ];

        $result = $this->job->toArray();

        $this->assertArraySubset($expectedArray, $result);
    }
}
