<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\Model\BaseModel;

class BaseModelTest extends BaseTestCase
{
    public function testCanReturnArrayRepresentation()
    {
        $modelA = new class('foo') extends BaseModel
        {
            public $foo;

            public function __construct($foo)
            {
                $this->foo = $foo;
            }
        };

        $modelB = new class('bar', $modelA) extends BaseModel
        {
            public $bar;
            public $modelA;

            public function __construct($bar, $modelA)
            {
                $this->bar = $bar;
                $this->modelA = $modelA;
            }
        };

        $expectedArray = [
            'bar' => 'bar',
            'modelA' => [
                'foo' => 'foo',
            ],
        ];

        $result = $modelB->toArray();

        $this->assertArraySubset($expectedArray, $result);
    }
}
