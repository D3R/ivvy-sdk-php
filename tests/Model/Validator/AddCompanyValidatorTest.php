<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model\Validator;

use Fcds\Ivvy\Model\BusinessRuleException;
use Fcds\Ivvy\Model\Address;
use Fcds\Ivvy\Model\Company;
use Fcds\Ivvy\Model\Validator\AddCompanyValidator;
use Fcds\Ivvy\Model\Validator\Validator;
use Fcds\IvvyTest\BaseTestCase;

/**
 * Class: AddCompanyValidatorTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Model\Validator\AddCompanyValidator
 * @covers Fcds\Ivvy\Model\Company
 */
final class AddCompanyValidatorTest extends BaseTestCase
{
    /** @var Validator */
    protected $validator;

    public function setUp()
    {
        $this->validator = new AddCompanyValidator();
    }

    public function testSuccessfulValidation()
    {
        $company = new Company([
            'businessName' => 'Acme',
            'address' => new Address([
                'countryCode' => 'AU',
                'stateCode'   => 'QLD',
                'postalCode'  => '4227',
            ]),
        ]);

        $result = $company->validate($this->validator);

        $this->assertTrue(true); // Everything is fine
    }

    public function testValidateCompanyWithNoBusinessName()
    {
        $this->expectException(BusinessRuleException::class);

        $company = new Company;

        $company->validate($this->validator);
    }

    public function testValidateCompanyWithNoAddressOrCountryCodeOrStateCodeOrPostalCode()
    {
         $this->expectException(BusinessRuleException::class);

         $company = new Company([
             'businessName' => 'Acme',
         ]);

        $company->validate($this->validator);
    }

    public function testValidateCompanyHasNoIdSet()
    {
        $this->expectException(BusinessRuleException::class);

        $company = new Company([
            'id' => 100,
            'businessName' => 'Acme',
        ]);

        $company->validate($this->validator);
    }
}
