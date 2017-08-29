<?php
declare(strict_types=1);

namespace Fcds\IvvyTest;

use Fcds\Ivvy\JobFactory;
use Fcds\Ivvy\Model\Company;
use Fcds\Ivvy\Model\Contact;
use Fcds\Ivvy\Model\Validator\Validator;
use Fcds\Ivvy\Model\Validator\AddCompanyValidator;
use Fcds\Ivvy\Model\Validator\UpdateCompanyValidator;
use Fcds\Ivvy\Model\Validator\AddContactValidator;
use Fcds\Ivvy\Model\Validator\UpdateContactValidator;

/**
 * Class: JobFactoryTest
 *
 * @see BaseTestCase
 * @final
 * @covers Fcds\Ivvy\JobFactory
 */
final class JobFactoryTest extends BaseTestCase
{
    /** @var JobFactory */
    protected $factory;

    /** Validators */
    protected $addCompanyValidatorMock;
    protected $updateCompanyValidatorMock;
    protected $addContactValidatorMock;
    protected $updateContactValidatorMock;


    public function setUp()
    {
        $this->addCompanyValidatorMock    = $this->createMock(AddCompanyValidator::class);
        $this->updateCompanyValidatorMock = $this->createMock(UpdateCompanyValidator::class);
        $this->addContactValidatorMock    = $this->createMock(AddContactValidator::class);
        $this->updateContactValidatorMock = $this->createMock(UpdateContactValidator::class);

        $this->factory = new JobFactory(
            $this->addCompanyValidatorMock,
            $this->updateCompanyValidatorMock,
            $this->addContactValidatorMock,
            $this->updateContactValidatorMock
        );
    }

    public function testCanCreatePingJob()
    {
        $expectedArray = [
            'namespace' => 'test',
            'action' => 'ping',
            'params' => [],
        ];

        $pingJob = $this->factory->newPingJob();

        $this->assertArraySubset($expectedArray, $pingJob->toArray());
    }

    public function testCanCreateAddCompanyJob()
    {
        $expectedArray = [
            'namespace' => 'contact', // see page 28 and 29 from the API PDF.
            'action' => 'addOrUpdateCompany',
            'params' => [
                'businessName' => 'Acme',
            ],
        ];

        $company = new Company([
            'businessName' => 'Acme',
            'phone' => '+18888888',
        ]);

        $this->addCompanyValidatorMock
            ->expects($this->once())
            ->method('processBusinessRules')
            ->willReturn([]);

        $result = $this->factory->newAddCompanyJob($company);

        $this->assertArraySubset($expectedArray, $result->toArray());
    }

    public function testCanCreateUpdateCompanyJob()
    {
        $expectedArray = [
            'namespace' => 'contact', // see page 28 and 29 from the API PDF.
            'action' => 'addOrUpdateCompany',
            'params' => [
                'id' => 100,
            ],
        ];

        $company = new Company([
            'id' => 100,
            'businessName' => 'Acme',
        ]);

        $this->updateCompanyValidatorMock
            ->expects($this->once())
            ->method('processBusinessRules')
            ->willReturn([]);

        $result = $this->factory->newUpdateCompanyJob($company);

        $this->assertArraySubset($expectedArray, $result->toArray());
    }

    public function testCanCreateAddContactJob()
    {
        $expectedArray = [
            'namespace' => 'contact',
            'action' => 'addOrUpdateContact',
            'params' => [
                'firstName' => 'John',
                'lastName' => 'Doe',
            ],
        ];

        $contact = new Contact([
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        $this->addContactValidatorMock
            ->expects($this->once())
            ->method('processBusinessRules')
            ->willReturn([]);

        $result = $this->factory->newAddContactJob($contact);

        $this->assertArraySubset($expectedArray, $result->toArray());
    }
}
