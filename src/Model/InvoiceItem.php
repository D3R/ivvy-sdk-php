<?php
declare(strict_types=1);

namespace Fcds\Ivvy\Model;

class InvoiceItem extends BaseModel
{
    public $description;
    public $quantity;
    public $unityCost;
    public $totalCost;
    public $totalTaxCost;
    public $amountPaid;
    public $refType;

    /**
     * Construct a new InvoiceItem object
     *
     * keys:
     * <pre>
     * description (string)
     * quantity (int)
     * unityCost (string)
     * totalCost (string)
     * totalTaxCost (string)
     * amountPaid (string)
     * refType (string)
     * </pre>
     *
     * @param array $props
     */
    public function __construct(array $props = [])
    {
        $this->description  = $props['description'] ?? null;
        $this->quantity     = $props['quantity'] ?? 0;
        $this->unityCost    = $props['unityCost'] ?? null;
        $this->totalCost    = $props['totalCost'] ?? null;
        $this->totalTaxCost = $props['totalTaxCost'] ?? null;
        $this->amountPaid   = $props['amountPaid'] ?? null;
        $this->refType      = $props['refType'] ?? null;
    }
}
