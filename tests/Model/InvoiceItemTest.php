<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model;

use Fcds\IvvyTest\BaseTestCase;
use Fcds\Ivvy\Model\InvoiceItem;

/**
 * Class: InvoiceItemTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Model\InvoiceItem
 */
class InvoiceItemTest extends BaseTestCase
{
    public function testInstantiateWithArguments()
    {
        $item = new InvoiceItem([
            'description'  => 'foo',
            'quantity'     => 3,
            'unityCost'    => '10.20',
            'totalCost'    => '30.60',
            'totalTaxCost' => '2.01',
            'amountPaid'   => '32.07',
            'refType'      => 'foo',
        ]);

        $this->assertEquals('foo', $item->description);
        $this->assertEquals(3, $item->quantity);
        $this->assertEquals('10.20', $item->unityCost);
        $this->assertEquals('30.60', $item->totalCost);
        $this->assertEquals('2.01', $item->totalTaxCost);
        $this->assertEquals('32.07', $item->amountPaid);
        $this->assertEquals('foo', $item->refType);
    }

    public function testInstantiateWithDefaultValues()
    {
        $item = new InvoiceItem;

        $this->assertEquals(null, $item->description);
        $this->assertEquals(0, $item->quantity);
        $this->assertEquals(null, $item->unityCost);
        $this->assertEquals(null, $item->totalCost);
        $this->assertEquals(null, $item->totalTaxCost);
        $this->assertEquals(null, $item->amountPaid);
        $this->assertEquals(null, $item->refType);
    }
}
