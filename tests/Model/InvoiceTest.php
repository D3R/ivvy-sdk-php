<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model;

use Fcds\IvvyTest\BaseTestCase;
use Fcds\Ivvy\Model\Address;
use Fcds\Ivvy\Model\Invoice;
use Fcds\Ivvy\Model\InvoiceItem;

/**
 * Class: InvoiceTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Model\Invoice
 */
class InvoiceTest extends BaseTestCase
{
    public function testInstantiateWithArguments()
    {
        $address = new Address;
        $items = [new InvoiceItem];
        $invoice = new Invoice([
            'id'             => 100,
            'reference'      => 'foo',
            'title'          => 'bar',
            'description'    => 'baz',
            'totalCost'      => '100.00',
            'totalTaxCost'   => '7.01',
            'amountPaid'     => '89.02',
            'toContactEmail' => 'john@mail.com',
            'toContactName'  => 'john',
            'currentStatus'  => 2,
            'createdDate'    => '2017-02-22',
            'modifiedDate'   => '2017-02-22',
            'refType'        => 3,
            'refId'          => 'grault',
            'taxRateUsed'    => 'garply',
            'isTaxCharged'   => true,
            'paymentDueDate' => '2017-02-21',
            'eventId'        => 200,
            'venueId'        => 300,
            'toContactId'    => 400,
            'toAddress'      => $address,
            'items'          => $items,
        ]);

        $this->assertEquals(100, $invoice->id);
        $this->assertEquals('foo', $invoice->reference);
        $this->assertEquals('bar', $invoice->title);
        $this->assertEquals('baz', $invoice->description);
        $this->assertEquals('100.00', $invoice->totalCost);
        $this->assertEquals('7.01', $invoice->totalTaxCost);
        $this->assertEquals('89.02', $invoice->amountPaid);
        $this->assertEquals('john@mail.com', $invoice->toContactEmail);
        $this->assertEquals('john', $invoice->toContactName);
        $this->assertEquals(2, $invoice->currentStatus);
        $this->assertEquals('2017-02-22', $invoice->createdDate);
        $this->assertEquals('2017-02-22', $invoice->modifiedDate);
        $this->assertEquals(3, $invoice->refType);
        $this->assertEquals('grault', $invoice->refId);
        $this->assertEquals('garply', $invoice->taxRateUsed);
        $this->assertEquals(true, $invoice->isTaxCharged);
        $this->assertEquals('2017-02-21', $invoice->paymentDueDate);
        $this->assertEquals(200, $invoice->eventId);
        $this->assertEquals(300, $invoice->venueId);
        $this->assertEquals(400, $invoice->toContactId);
        $this->assertEquals($address, $invoice->toAddress);
        $this->assertEquals($items, $invoice->items);
    }

    public function testInstantiateWithDefaultValues()
    {
        $invoice = new Invoice;

        $this->assertEquals(0, $invoice->id);
        $this->assertEquals(null, $invoice->reference);
        $this->assertEquals(null, $invoice->title);
        $this->assertEquals(null, $invoice->description);
        $this->assertEquals(null, $invoice->totalCost);
        $this->assertEquals(null, $invoice->totalTaxCost);
        $this->assertEquals(null, $invoice->amountPaid);
        $this->assertEquals(null, $invoice->toContactEmail);
        $this->assertEquals(null, $invoice->toContactName);
        $this->assertEquals(0, $invoice->currentStatus);
        $this->assertEquals(null, $invoice->createdDate);
        $this->assertEquals(null, $invoice->modifiedDate);
        $this->assertEquals(null, $invoice->refType);
        $this->assertEquals(0, $invoice->refId);
        $this->assertEquals(null, $invoice->taxRateUsed);
        $this->assertEquals(null, $invoice->isTaxCharged);
        $this->assertEquals(null, $invoice->paymentDueDate);
        $this->assertEquals(null, $invoice->eventId);
        $this->assertEquals(null, $invoice->venueId);
        $this->assertEquals(null, $invoice->toContactId);
        $this->assertEquals(null, $invoice->toAddress);
        $this->assertEquals(null, $invoice->items);
    }
}
