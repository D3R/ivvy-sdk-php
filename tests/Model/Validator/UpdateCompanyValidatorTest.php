<?php
declare(strict_types=1);

namespace Fcds\IvvyTest\Model\Validator;

use Fcds\Ivvy\Model\BusinessRuleException;
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

    public function testValidateCompanyHasId()
    {
        $company = new Company([
            'id' => 100,
        ]);

        $result = $company->validate($this->validator);

        $this->assertTrue(true); // nothing bad happened
    }

    public function testValidateCompanyWithNoId()
    {
        $this->expectException(BusinessRuleException::class);

        $company = new Company;

        $result = $company->validate($this->validator);
    }
}
