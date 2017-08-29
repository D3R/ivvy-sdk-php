<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Error;
use Fcds\Ivvy\Ivvy;
use Fcds\Ivvy\Job;
use Fcds\Ivvy\Signature;
use Fcds\IvvyTest\BaseTestCase;
use GuzzleHttp\Client;

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
