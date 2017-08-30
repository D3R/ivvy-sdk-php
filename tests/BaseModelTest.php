<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\Model\BaseModel;

class BaseModelTest extends BaseTestCase
{
    public function testCanReturnArrayRepresentation()
    {
        $expectedArray = [
            'bar' => 'bar',
            'dependent' => [
                'foo' => 'foo',
            ],
        ];

        $independentModel = $this->generateStubIndependentModel();

        $result = $independentModel->toArray();

        $this->assertArraySubset($expectedArray, $result);
    }

    public function testCanReturnArrayRepresentationByRemovingEmptyValues()
    {
        $expectedArray = [
            'bar' => 'bar',
            'dependent' => [
                'foo' => 'foo',
            ],
        ];

        $independentModel = $this->generateStubIndependentModel();

        $result = $independentModel->toArray(true);

        $this->assertEquals($expectedArray, $result);
    }

    protected function generateStubIndependentModel(): BaseModel
    {
        $dependent = new class('foo') extends BaseModel
        {
            public $foo;

            public function __construct($foo)
            {
                $this->foo = $foo;
            }
        };

        $independent = new class('bar', $dependent) extends BaseModel
        {
            public $bar;
            public $qux;
            public $corge;
            public $dependent;

            public function __construct($bar, $dependent)
            {
                $this->bar = $bar;
                $this->dependent = $dependent;
            }
        };

        return $independent;
    }
}
