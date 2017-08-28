<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Error;
use Fcds\Ivvy\Ivvy;
use Fcds\Ivvy\Signature;
use Fcds\IvvyTest\BaseTestCase;
use GuzzleHttp\Client;

/**
 * Class: IvvyTest
 *
 * @see BaseTestCase
 * @final
 * @covers Ivvy
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

        $this->ivvy = Ivvy::getInstance(
            $this->apiKey,
            $this->apiSecret,
            $this->signatureMock,
            $this->clientMock
        );
    }

    public function testCannotBeInstantiated()
    {
        $this->expectException(Error::class);

        new Ivvy();
    }

    public function testPingSuccess()
    {
        $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse());

        $result = $this->ivvy->ping();

        $this->assertTrue($result);
    }

    public function testPingFailure()
    {
         $this->clientMock
            ->method('request')
            ->willReturn($this->generateStubResponse(404));

        $result = $this->ivvy->ping();

        $this->assertFalse($result);

    }

    /**
     * Utility method to generate a stub response for the Guzzle client
     * with the passed status code and body.
     *
     * @param int $statusCode
     * @param mixed $body
     */
    private function generateStubResponse(int $statusCode = 200, $body = null) {
        return new class($statusCode, $body) {
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
