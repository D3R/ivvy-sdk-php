<?php
declare(strict_types=1);

namespace Fcds\Ivvy;

use InvalidArgumentException;
use Fcds\Ivvy\Model\Company;

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
}
