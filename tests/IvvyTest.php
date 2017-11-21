<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Error;
use Fcds\Ivvy\Ivvy;
use Fcds\Ivvy\Job;
use Fcds\Ivvy\Signature;
use Fcds\IvvyTest\BaseTestCase;
use GuzzleHttp\Client;
use Fcds\Ivvy\Model\Company;
use Fcds\Ivvy\Model\Invoice;
use Fcds\Ivvy\Model\InvoiceItem;
use Fcds\Ivvy\Model\Address;
use Fcds\Ivvy\Model\Contact;
use Fcds\Ivvy\Model\Booking;

/**
 * Class: IvvyTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Ivvy
 */
final class IvvyTest extends BaseTestCase
{
    /** @var string */
    protected $apiKey;

    /** @var string */
    protected $apiSecret;

    /** @var Ivvy */
    protected $ivvy;

    public function setUp(): void
    {
        $this->apiKey = 'foo';
        $this->apiSecret = 'bar';
        $this->signatureMock = $this->createMock(Signature::class);
        $this->clientMock = $this->createMock(Client::class);

        $this->signatureMock
            ->method('sign')
            ->willReturn('baz');

        $this->ivvy = new Ivvy(
            $this->apiKey,
            $this->apiSecret,
            $this->signatureMock,
            $this->clientMock
        );
    }

    public function testPingSuccess(): void
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse());

        $result = $this->ivvy->ping();

        $this->assertTrue($result);
    }

    public function testPingFailure(): void
    {
         $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(404));

        $result = $this->ivvy->ping();

        $this->assertFalse($result);
    }

    public function testBatchRunSuccess(): void
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(200, json_encode(['asyncId' => 'foo'])));

        $job1 = new Job('foo', 'bar');
        $job2 = new Job('baz', 'qux');

        $result = $this->ivvy->run([$job1, $job2]);

        $this->assertEquals('foo', $result);
    }

    public function testBatchRunFailure(): void
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400));

        $job1 = new Job('foo', 'bar');
        $job2 = new Job('baz', 'qux');

        $result = $this->ivvy->run([$job1, $job2]);

        $this->assertNull($result);
    }

    public function testBatchResultSuccess(): void
    {
        $response = [
            'results' => [
                [
                    'namespace' => 'foo',
                    'action'    => 'bar',
                    'request' => [
                    ],
                    'response' => [
                    ],
                ],
            ],
        ];

        $expectedResult = array_merge(['success' => true], $response);

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(200, json_encode($response)));

        $result = $this->ivvy->result('foobar');

        $this->assertArraySubset($expectedResult, $result);
    }

    public function testBatchResultFailureNotCompleted(): void
    {
        $response = [
            'errorCode'    => 400,
            'specificCode' => 24114,
        ];

        $expectedResult = [
            'success' => false,
            'error'   => 'not_completed',
        ];

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400, json_encode($response)));

        $result = $this->ivvy->result('foobar');

        $this->assertArraySubset($expectedResult, $result);
    }

    public function testBatchResultFailure(): void
    {
        $expectedResult = [
            'success' => false,
            'error'   => 'unknown',
        ];

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400));

        $result = $this->ivvy->result('foobar');

        $this->assertArraySubset($expectedResult, $result);
    }

    public function testGetCompanyListSuccess(): void
    {
        $response = [
            'results' => [
                [
                    'businessName' => 'foo1',
                    'address' => [
                        'line1' => 'bar1',
                    ],
                ],
                [
                    'businessName' => 'foo2',
                    'address' => [
                        'line1' => 'bar2',
                    ],
                ],
            ],
        ];

        $expectedResult = [
            new Company([
                'businessName' => 'foo1',
                'address' => new Address([
                    'line1' => 'bar1',
                ]),
            ]),
            new Company([
                'businessName' => 'foo2',
                'address' => new Address([
                    'line1' => 'bar2',
                ]),
            ]),
        ];

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(200, json_encode($response)));

        $companies = $this->ivvy->getCompanyList();

        $this->assertCount(2, $companies);
        $this->assertEquals($expectedResult[0]->businessName, $companies[0]->businessName);
        $this->assertEquals($expectedResult[0]->address->line1, $companies[0]->address->line1);
        $this->assertEquals($expectedResult[1]->businessName, $companies[1]->businessName);
        $this->assertEquals($expectedResult[1]->address->line1, $companies[1]->address->line1);
        $this->assertEquals($expectedResult, $companies);
    }

    public function testGetCompanyListFail(): void
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400));

        $companies = $this->ivvy->getCompanyList();

        $this->assertNull($companies);
    }

    public function testGetInvoiceListSuccess()
    {
        $response = [
            'results' => [
                ['reference' => 'foo'],
                ['reference' => 'bar'],
            ],
        ];

        $expectedResult = [
            new Invoice(['reference' => 'foo']),
            new Invoice(['reference' => 'bar']),
        ];

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(200, json_encode($response)));

        $invoices = $this->ivvy->getInvoiceList();

        $this->assertCount(2, $invoices);
        $this->assertEquals($expectedResult[0]->reference, $invoices[0]->reference);
        $this->assertEquals($expectedResult[1]->reference, $invoices[1]->reference);
        $this->assertEquals($expectedResult, $invoices);
    }

    public function testGetInvoiceListFail()
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400));

        $invoices = $this->ivvy->getInvoiceList();

        $this->assertNull($invoices);
    }

    public function testGetInvoiceListFromDateSuccess()
    {
        $response = [
            'results' => [
                ['reference' => 'foo'],
                ['reference' => 'bar'],
            ],
        ];

        $expectedResult = [
            new Invoice(['reference' => 'foo']),
            new Invoice(['reference' => 'bar']),
        ];

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(200, json_encode($response)));

        $invoices = $this->ivvy->getInvoiceListFromDate('2017-01-01');

        $this->assertCount(2, $invoices);
        $this->assertEquals($expectedResult[0]->reference, $invoices[0]->reference);
        $this->assertEquals($expectedResult[1]->reference, $invoices[1]->reference);
        $this->assertEquals($expectedResult, $invoices);
    }

    public function testGetInvoiceListFromDateFail()
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400));

        $invoices = $this->ivvy->getInvoiceListFromDate('2017-01-01');

        $this->assertNull($invoices);
    }

    public function testGetInvoiceSuccess()
    {
        $response = [
            'reference' => 'foo',
            'items' => [
                ['description' => 'bar'],
                ['description' => 'baz'],
            ],
        ];

        $expectedInvoice = new Invoice([
            'reference' => 'foo',
            'items' => [
                new InvoiceItem(['description' => 'bar']),
                new InvoiceItem(['description' => 'baz']),
            ],
        ]);

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(200, json_encode($response)));

        $invoice = $this->ivvy->getInvoice(100);

        $this->assertEquals($expectedInvoice->reference, $invoice->reference);
        $this->assertEquals($expectedInvoice->items[0]->description, $invoice->items[0]->description);
        $this->assertEquals($expectedInvoice, $invoice);
    }

    public function testGetInvoiceFail()
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400));

        $invoice = $this->ivvy->getInvoice(100);

        $this->assertNull($invoice);
    }

    public function testGetBookingSuccess()
    {
        $response = [
            'id' => 100,
            'venueId' => 100,
            'code' => 'bar',
            'name' => 'baz',
            'company' => 100,
            'contact' => 100
        ];

        $expectedBooking = new Booking([
            'id' => 100,
            'venueId' => 100,
            'code' => 'bar',
            'name' => 'baz',
            'company' => 100,
            'contact' => 100
        ]);

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(200, json_encode($response)));

        $invoice = $this->ivvy->getBooking(100);

        $this->assertEquals($expectedBooking->id, $invoice->id);
        $this->assertEquals($expectedBooking->venueId, $invoice->venueId);
        $this->assertEquals($expectedBooking->code, $invoice->code);
        $this->assertEquals($expectedBooking->name, $invoice->name);
        $this->assertEquals($expectedBooking->company, $invoice->company);
        $this->assertEquals($expectedBooking->contact, $invoice->contact);
        $this->assertEquals($expectedBooking, $invoice);
    }

    public function testGetBookingFail()
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400));

        $invoice = $this->ivvy->getBooking(100);

        $this->assertNull($invoice);
    }

    public function testGetOptionsSuccess()
    {
        $response = [
            'invoiceRefTypes' => [],
            'invoiceLineRefTypes' => [],
            'paymentMethods' => [],
        ];

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(200, json_encode($response)));

        $options = $this->ivvy->getOptions();

        $this->assertEquals($response, $options);
    }

    public function testGetOptionsFail()
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400));

        $options = $this->ivvy->getOptions();

        $this->assertNull($options);
    }

    public function testGetContactListSuccess()
    {
        $response = [
            'results' => [
                ['firstName' => 'john'],
                ['firstName' => 'mary'],
            ],
        ];

        $expectedResult = [
            new Contact(['firstName' => 'john']),
            new Contact(['firstName' => 'mary']),
        ];

        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(200, json_encode($response)));

        $contacts = $this->ivvy->getContactList();

        $this->assertEquals($expectedResult, $contacts);
    }

    public function testGetContactListFail()
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(400));

        $contacts = $this->ivvy->getContactList();

        $this->assertNull($contacts);
    }

    /**
     * Utility method to generate a stub response for the Guzzle client
     * with the passed status code and body.
     *
     * @param int $statusCode
     * @param mixed $body
     */
    private function generateStubResponse(int $statusCode = 200, $body = null)
    {
        return new class($statusCode, $body)
        {
            public function __construct(int $statusCode, $body)
            {
                $this->statusCode = $statusCode;
                $this->body = $body;
            }

            public function getStatusCode()
            {
                return $this->statusCode;
            }

            public function getBody()
            {
                return $this->body;
            }
        };
    }
}
