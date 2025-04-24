<?php

class Basket
{
    private array $catalogue;
    private array $deliveryRules;
    private array $offers;
    private array $items = [];

    public function __construct(array $catalogue, array $deliveryRules, array $offers)
    {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function add(string $productCode): void
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new Exception("Product code {$productCode} not found in catalogue.");
        }

        $this->items[] = $productCode;
    }

    public function total(): float
    {
        $itemCounts = array_count_values($this->items);
        $subtotal = 0.0;

        foreach ($itemCounts as $code => $count) {
            $price = $this->catalogue[$code]['price'];

            if (isset($this->offers[$code])) {
                $subtotal += $this->priceOffer($code, $count, $price);
            } else {
                $subtotal += $price * $count;
            }
        }

        $delivery = $this->deliveryCost($subtotal);

        return round($subtotal + $delivery, 2);
    }


    private function priceOffer(string $code, int $count, float $price): float
    {
        $offer = $this->offers[$code];

        if ($offer[0] === 'buy_one_get_half') {
            $pairs = intdiv($count, 2);
            $remainder = $count % 2;
            $offerTotal = $pairs * ($price + ($price / 2)) + ($remainder * $price);
            return $offerTotal;
        }

        return $count * $price;
    }

    private function deliveryCost(float $subtotal): float
    {
        foreach ($this->deliveryRules as $threshold => $cost) {
            if ($subtotal < $threshold) {
                return $cost;
            }
        }
        return 0.0;
    }
}
