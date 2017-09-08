<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

class Invoice extends BaseModel
{
    public $id;
    public $reference;
    public $title;
    public $description;
    public $totalCost;
    public $totalTaxCost;
    public $amountPaid;
    public $toContactEmail;
    public $toContactName;
    public $currentStatus;
    public $createdDate;
    public $modifiedDate;
    public $refType;
    public $refId;
    public $taxRateUsed;
    public $isTaxCharged;
    public $paymentDueDate;
    public $eventId;
    public $venueId;
    public $toContactId;
    public $toAddress;
    public $items;
    //public $payments;

    /**
     * Construct a new Invoice object
     *
     * keys:
     * <pre>
     * id (int)
     * reference (string)
     * title (string)
     * description (string)
     * totalCost (string)
     * totalTaxCost (string)
     * amountPaid (string)
     * toContactEmail (string)
     * toContactName (string)
     * currentStatus (int)
     * createdDate (string)
     * modifiedDate (string)
     * refType (int)
     * refId (string)
     * taxRateUsed (string)
     * isTaxCharged (bool)
     * paymentDueDate (string)
     * eventId (string)
     * venueId (string)
     * toContactId (string)
     * toAddress (Address)
     * items (array<InvoiceItem>)
     * </pre>
     */
    public function __construct(array $props = [])
    {
        $this->id             = $props['id'] ?? 0;
        $this->reference      = $props['reference'] ?? null;
        $this->title          = $props['title'] ?? null;
        $this->description    = $props['description'] ?? null;
        $this->totalCost      = $props['totalCost'] ?? null;
        $this->totalTaxCost   = $props['totalTaxCost'] ?? null;
        $this->amountPaid     = $props['amountPaid'] ?? null;
        $this->toContactEmail = $props['toContactEmail'] ?? null;
        $this->toContactName  = $props['toContactName'] ?? null;
        $this->currentStatus  = $props['currentStatus'] ?? 0;
        $this->createdDate    = $props['createdDate'] ?? null;
        $this->modifiedDate   = $props['modifiedDate'] ?? null;
        $this->refType        = $props['refType'] ?? null;
        $this->refId          = $props['refId'] ?? 0;
        $this->taxRateUsed    = $props['taxRateUsed'] ?? null;
        $this->isTaxCharged   = $props['isTaxCharged'] ?? null;
        $this->paymentDueDate = $props['paymentDueDate'] ?? null;
        $this->eventId        = $props['eventId'] ?? null;
        $this->venueId        = $props['venueId'] ?? null;
        $this->toContactId    = $props['toContactId'] ?? null;
        $this->toAddress      = $props['toAddress'] ?? null;
        $this->items          = $props['items'] ?? null;
    }
}
