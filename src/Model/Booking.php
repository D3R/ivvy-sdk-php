<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

class Booking extends BaseModel
{
    public $id;
    public $venueId;
    public $code;
    public $name;
    public $company;
    public $contact;
    public $currentStatus;
    public $totalAmount;
    public $totalTaxAmount;
    public $amountOutstanding;
    public $accountTimezone;
    public $venueTimezone;
    public $createdDate;
    public $modifiedDate;
    public $dateEventStart;
    public $dateEventEnd;
    public $isAccommIncluded;
    public $dateAccomStart;
    public $dateAccomEnd;
    public $hasPackages;
    public $decisionDate;
    public $isBeoFinalised;
    public $beoFinalisedDate;

    /**
     * Construct a new Booking object
     *
     * keys:
     * <pre>
     * id (integer)
     * venueId (integer)
     * code (string)
     * name (string)
     * company (integer)
     * contact (integer)
     * currentStatus (integer)
     * totalAmount (double)
     * totalTaxAmount (double)
     * amountOutstanding (double)
     * accountTimezone (string)
     * venueTimezone (string)
     * createdDate (string)
     * modifiedDate (string)
     * dateEventStart (string)
     * dateEventEnd (string)
     * isAccommIncluded (bool)
     * dateAccomStart (string)
     * dateAccomEnd (string)
     * hasPackages (bool)
     * decisionDate (string)
     * isBeoFinalised (bool)
     * beoFinalisedDate (string)
     * </pre>
     *
     * @param array $props
     */
    public function __construct(array $props = [])
    {
        $this->id = $props['id'] ?? 0;
        $this->venueId = $props['venueId'] ?? 0;
        $this->code = $props['code'] ?? null;
        $this->name = $props['name'] ?? null;
        $this->company = $props['company'] ?? 0;
        $this->contact = $props['contact'] ?? 0;
        $this->currentStatus = $props['currentStatus'] ?? 0;
        $this->totalAmount = $props['totalAmount'] ?? 0;
        $this->totalTaxAmount = $props['totalTaxAmount'] ?? 0;
        $this->amountOutstanding = $props['amountOutstanding'] ?? 0;
        $this->accountTimezone = $props['accountTimezone'] ?? null;
        $this->venueTimezone = $props['venueTimezone'] ?? null;
        $this->createdDate = $props['createdDate'] ?? null;
        $this->modifiedDate = $props['modifiedDate'] ?? null;
        $this->dateEventStart = $props['dateEventStart'] ?? null;
        $this->dateEventEnd = $props['dateEventEnd'] ?? null;
        $this->isAccommIncluded = $props['isAccommIncluded'] ?? false;
        $this->dateAccomStart = $props['dateAccomStart'] ?? null;
        $this->dateAccomEnd = $props['dateAccomEnd'] ?? null;
        $this->hasPackages = $props['hasPackages'] ?? false;
        $this->decisionDate = $props['decisionDate'] ?? null;
        $this->isBeoFinalised = $props['isBeoFinalised'] ?? false;
        $this->beoFinalisedDate = $props['beoFinalisedDate'] ?? null;
    }
}
