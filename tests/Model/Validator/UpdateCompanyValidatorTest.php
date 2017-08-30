<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model\Validator;

use Fcds\Ivvy\Model\BusinessRuleException;
use Fcds\Ivvy\Model\Address;
use Fcds\Ivvy\Model\Company;
use Fcds\Ivvy\Model\Validator\UpdateCompanyValidator;
use Fcds\Ivvy\Model\Validator\Validator;
use Fcds\IvvyTest\BaseTestCase;

/**
 * Class: UpdateCompanyValidatorTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\Model\Validator\UpdateCompanyValidator
 * @covers Fcds\Ivvy\Model\Company
 */
final class UpdateCompanyValidatorTest extends BaseTestCase
{
    /** @var Validator */
    protected $validator;

    public function setUp()
    {
        $this->validator = new UpdateCompanyValidator();
    }

    public function testSuccessfulValidation()
    {
        $company = new Company([
            'id' => 100,
            'address' => new Address([
                'countryCode' => 'AU',
                'stateCode'   => 'QLD',
                'postalCode'  => '4227',
            ]),
        ]);

        $result = $company->validate($this->validator);

        $this->assertTrue(true); // Everythign is fine
    }

    public function testValidateCompanyWithNoAddressOrCountryCodeOrStateCodeOrPostalCode()
    {
         $this->expectException(BusinessRuleException::class);

         $company = new Company([
             'id' => 100,
         ]);

        $company->validate($this->validator);
    }

    public function testValidateCompanyWithNoId()
    {
        $this->expectException(BusinessRuleException::class);

        $company = new Company;

        $result = $company->validate($this->validator);
    }
}
