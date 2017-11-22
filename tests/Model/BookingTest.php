<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model;

use Fcds\Ivvy\Model\Booking;
use Fcds\Ivvy\Model\Address;
use Fcds\Ivvy\Model\Contact;
use Fcds\Ivvy\Model\Company;
use Fcds\Ivvy\Model\CustomField;
use Fcds\IvvyTest\BaseTestCase;

/**
 * Class: BookingTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Model\Booking
 */
class BookingTest extends BaseTestCase
{
    public function testInstantiateWithArguments()
    {
        $company = [new Company()];
        $contact = [new Contact()];

        $booking = new Booking([
            'id' => 100,
            'venueId' => 100,
            'code' => 'bar',
            'name' => 'baz',
            'company' => $company,
            'contact' => $contact,
            'currentStatus' => 1,
            'totalAmount' => '100.1',
            'totalTaxAmount' => '100.2',
            'amountOutstanding' => '100.2',
            'accountTimezone' => 'America/Bogota',
            'venueTimezone' => 'America/Panama',
            'createdDate' => '2017-02-22',
            'modifiedDate' => '2017-02-22',
            'dateEventStart' => '2017-02-22',
            'dateEventEnd' => '2017-02-22',
            'isAccommIncluded' => true,
            'dateAccomStart' => '2017-02-22',
            'dateAccomEnd' => '2017-02-22',
            'hasPackages' => true,
            'decisionDate' => '2017-02-22',
            'isBeoFinalised' => true,
            'beoFinalisedDate' => '2017-02-22'
        ]);

        $this->assertEquals(100, $booking->id);
        $this->assertEquals(100, $booking->venueId);
        $this->assertEquals('bar', $booking->code);
        $this->assertEquals('baz', $booking->name);
        $this->assertEquals(0, $booking->company);
        $this->assertEquals(0, $booking->contact);
        $this->assertEquals(1, $booking->currentStatus);
        $this->assertEquals(100.1, $booking->totalAmount);
        $this->assertEquals(100.2, $booking->totalTaxAmount);
        $this->assertEquals(100.2, $booking->amountOutstanding);
        $this->assertEquals('America/Bogota', $booking->accountTimezone);
        $this->assertEquals('America/Panama', $booking->venueTimezone);
        $this->assertEquals('2017-02-22', $booking->createdDate);
        $this->assertEquals('2017-02-22', $booking->modifiedDate);
        $this->assertEquals('2017-02-22', $booking->dateEventStart);
        $this->assertEquals('2017-02-22', $booking->dateEventEnd);
        $this->assertEquals(true, $booking->isAccommIncluded);
        $this->assertEquals('2017-02-22', $booking->dateAccomStart);
        $this->assertEquals('2017-02-22', $booking->dateAccomEnd);
        $this->assertEquals(true, $booking->hasPackages);
        $this->assertEquals('2017-02-22', $booking->decisionDate);
        $this->assertEquals(true, $booking->isBeoFinalised);
        $this->assertEquals('2017-02-22', $booking->beoFinalisedDate);
    }

    public function testInstantiateWithDefaultValues()
    {
        $booking = new Booking;

        $this->assertEquals(0, $booking->id);
        $this->assertEquals(0, $booking->venueId);
        $this->assertNull($booking->code);
        $this->assertNull($booking->name);
        $this->assertEquals(0, $booking->company);
        $this->assertEquals(0, $booking->contact);
        $this->assertEquals(0, $booking->currentStatus);
        $this->assertEquals(0, $booking->totalAmount);
        $this->assertEquals(0, $booking->totalTaxAmount);
        $this->assertEquals(0, $booking->amountOutstanding);
        $this->assertNull($booking->accountTimezone);
        $this->assertNull($booking->venueTimezone);
        $this->assertNull($booking->createdDate);
        $this->assertNull($booking->modifiedDate);
        $this->assertNull($booking->dateEventStart);
        $this->assertNull($booking->dateEventEnd);
        $this->assertEquals(false, $booking->isAccommIncluded);
        $this->assertNull($booking->dateAccomStart);
        $this->assertNull($booking->dateAccomEnd);
        $this->assertEquals(false, $booking->hasPackages);
        $this->assertNull($booking->decisionDate);
        $this->assertEquals(false, $booking->isBeoFinalised);
        $this->assertNull($booking->beoFinalisedDate);
    }
}
