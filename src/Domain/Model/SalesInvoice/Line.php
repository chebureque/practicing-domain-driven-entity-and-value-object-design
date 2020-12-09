<?php
declare(strict_types=1);

namespace Domain\Model\SalesInvoice;

use DateTime;
use InvalidArgumentException;

final class Line
{
    /**
     * @var int
     */
    private $productId;

    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $quantity;

    /**
     * @var int
     */
    private $quantityPrecision;

    /**
     * @var float
     */
    private $tariff;

    /**
     * @var string
     */
    private $currency;

    private Discount $discount;

    /**
     * @var string
     */
    private $vatCode;

    /**
     * @var float|null
     */
    private $exchangeRate;

    public function __construct(
        int $productId,
        string $description,
        float $quantity,
        int $quantityPrecision,
        float $tariff,
        string $currency,
        Discount $discount,
        string $vatCode,
        ?float $exchangeRate
    ) {
        $this->productId = $productId;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->quantityPrecision = $quantityPrecision;
        $this->tariff = $tariff;
        $this->currency = $currency;
        $this->discount = $discount;
        $this->vatCode = $vatCode;
        $this->exchangeRate = $exchangeRate;
    }

    public function amount(): float
    {
        return round(round($this->quantity, $this->quantityPrecision) * $this->tariff, 2);
    }

    public function discountAmount(): float
    {
        return $this->discount->discountAmount($this->amount());
    }

    public function netAmount(): float
    {
        return round($this->amount() - $this->discountAmount(), 2);
    }

    public function vatAmount(?DateTime $now = null): float
    {
        $vatRate = $this->vatRateForVatCodeAtDate($now ?? new DateTime(), $this->vatCode);

        return round($this->netAmount() * $vatRate / 100, 2);
    }

    private function vatRateForVatCodeAtDate(DateTime $now, string $vatCode): float
    {
        $vatRates = new VatRates();
        return $vatRates->vatRateForVatCodeAtDate($now, $vatCode);
    }
}
