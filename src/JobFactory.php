<?php
declare(strict_types=1);

namespace Fcds\Ivvy;

use Fcds\Ivvy\Model\Company;
use Fcds\Ivvy\Model\Contact;
use Fcds\Ivvy\Model\Validator\Validator;

/**
 * Class: JobFactory
 *
 * @final
 */
final class JobFactory
{
    /** Validators */
    protected $addCompanyValidator;
    protected $updateCompanyValidator;
    protected $addContactValidator;
    protected $updateContactValidator;

    public function __construct(
        Validator $addCompanyValidator,
        Validator $updateCompanyValidator,
        Validator $addContactValidator,
        Validator $updateContactValidator
    ) {
        $this->addCompanyValidator    = $addCompanyValidator;
        $this->updateCompanyValidator = $updateCompanyValidator;
        $this->addContactValidator    = $addContactValidator;
        $this->updateContactValidator = $updateContactValidator;
    }

    /**
     * Creates a job for the ping endpoint
     *
     * @return Job
     */
    public function newPingJob(): Job
    {
        return new Job('test', 'ping');
    }

    public function newAddCompanyJob(Company $company)
    {
        $this->addCompanyValidator->processBusinessRules($company);

        return $this->newAddOrUpdateCompanyJob($company);
    }

    public function newUpdateCompanyJob(Company $company)
    {
        $this->updateCompanyValidator->processBusinessRules($company);

        return $this->newAddOrUpdateCompanyJob($company);
    }

    protected function newAddOrUpdateCompanyJob(Company $company)
    {
        return new Job('contact', 'addOrUpdateCompany', $company->toArray());
    }

    public function newAddContactJob(Contact $contact)
    {
        $this->addContactValidator->processBusinessRules($contact);

        return $this->newAddOrUpdateContactJob($contact);
    }

    protected function newAddOrUpdateContactJob(Contact $contact)
    {
        return new Job('contact', 'addOrUpdateContact', $contact->toArray());
    }
}
