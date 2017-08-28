<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\Ivvy;
use Fcds\Ivvy\IvvyFactory;
use Fcds\IvvyTest\BaseTestCase;

final class IvvyFactoryTest extends BaseTestCase
{
    protected $factory;

    public function testCanCreateIvvyInstance()
    {
        $this->factory = new IvvyFactory;

        $ivvy = $this->factory->newInstance('foo', 'bar');

        $this->assertInstanceOf(Ivvy::class, $ivvy);
    }
}
