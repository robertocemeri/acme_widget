# Shopping Basket Implementation

A PHP implementation of a shopping basket system that handles product pricing, special offers, and delivery costs.

## Features

- Product catalogue management
- Special offer support (Buy one get second half price)
- Tiered delivery cost rules
- Precise price calculations with rounding to 2 decimal places

## Usage

```php
// Initialize the basket with catalogue, delivery rules and offers
$basket = new Basket($catalogue, $deliveryRules, $offers);

// Add items to basket
$basket->add('R01');
$basket->add('G01');

// Calculate total
$total = $basket->total();
```

## Configuration Structure

### Product Catalogue
Products are defined with a code, name, and price:
```php
$catalogue = [
    'R01' => ['name' => 'Red Widget', 'price' => 32.95],
    'G01' => ['name' => 'Green Widget', 'price' => 24.95],
    'B01' => ['name' => 'Blue Widget', 'price' => 7.95],
];
```

### Delivery Rules
Delivery costs are defined by order value thresholds:
```php
$deliveryRules = [
    50 => 4.95,  // Orders under $50: $4.95 delivery
    90 => 2.95,  // Orders under $90: $2.95 delivery
];                // Orders $90 and over: Free delivery
```

### Special Offers
Offers are defined per product:
```php
$offers = [
    'R01' => ['buy_one_get_half'], // Second Red Widget is half price
];
```

## Assumptions

1. **Product Codes**
   - Product codes must exist in the catalogue
   - Product codes are case-sensitive

2. **Pricing**
   - All prices are in dollars and stored as floats
   - Final totals are rounded to 2 decimal places

3. **Delivery Rules**
   - Delivery rules are applied based on the subtotal before delivery
   - Rules are processed in ascending order of threshold
   - Orders above the highest threshold get free delivery

4. **Special Offers**
   - Currently supports "buy one get half price" offer type

## Error Handling

The system will throw an Exception if:
- An attempt is made to add a product with an invalid product code