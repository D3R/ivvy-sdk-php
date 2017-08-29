<?php
declare(strict_types=1);

namespace Fcds\Ivvy;

use InvalidArgumentException;
use Fcds\Ivvy\Model\Company;
use Fcds\Ivvy\Model\Contact;

/**
 * Class: JobFactory
 *
 * @final
 */
final class JobFactory
{
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
        if (! $company->businessName) {
            throw new InvalidArgumentException('A businessName is needed to add a Company');
        }

        if ($company->id) {
            throw new InvalidArgumentException('Cannot add a Company that already has an id');
        }

        return $this->newAddOrUpdateCompanyJob($company);
    }

    public function newUpdateCompanyJob(Company $company)
    {
        if (! $company->id) {
            throw new InvalidArgumentException('An id is needed to update a Company');
        }

        return $this->newAddOrUpdateCompanyJob($company);
    }

    protected function newAddOrUpdateCompanyJob(Company $company)
    {
        return new Job('contact', 'addOrUpdateCompany', $company->toArray());
    }

    public function newAddContactJob(Contact $contact)
    {
        if (! $contact->firstName || ! $contact->lastName) {
            throw new InvalidArgumentException('A firstName and a lastName is needed to add a Contact');
        }

        if ($contact->id) {
            throw new InvalidArgumentException('Cannot add a Contact that already has an id');
        }

        return $this->newAddOrUpdateContactJob($contact);
    }

    public function newAddOrUpdateContactJob(Contact $contact)
    {
        return new Job('contact', 'addOrUpdateContact', $contact->toArray());
    }
}
