<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\Signature;
use Fcds\IvvyTest\BaseTestCase;

/**
 * Class: SignatureTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Signature
 */
final class SignatureTest extends BaseTestCase
{
    protected $signature;

    public function setUp(): void
    {
        $this->signature = new Signature();
    }

    public function testCreatesSignature(): void
    {
        $body = json_encode(['example' => 'body']);
        $contentMd5 = md5($body);
        $requestUri = '/api/1.0/test?action=ping';
        $ivvyHeaders = ['IVVY-Date' => '2012-04-03 22:23:24'];
        $stringToSign = 'posta09f600c77a6dbd947db24c61e8935caapplication/json/api/1.0/test?action=ping1.0ivvydate=2012-04-03 22:23:24';
        $secret = 'foo';
        $expectedSignature = hash_hmac("sha1", $stringToSign, $secret);

        $signature = $this->signature->sign(
            $secret,
            $contentMd5,
            $requestUri,
            $ivvyHeaders
        );

        $this->assertEquals($expectedSignature, $signature);
    }
}
