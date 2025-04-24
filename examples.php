<?php

require_once 'Basket.php';

$catalogue = [
    'R01' => ['name' => 'Red Widget', 'price' => 32.95],
    'G01' => ['name' => 'Green Widget', 'price' => 24.95],
    'B01' => ['name' => 'Blue Widget', 'price' => 7.95],
];

$deliveryRules = [
    50 => 4.95,
    90 => 2.95,
];

$offers = [
    'R01' => ['buy_one_get_half'],
];

$basket = new Basket($catalogue, $deliveryRules, $offers);

$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');

echo "2 B01 3 R01 Total: $" . $basket->total();

$basket = new Basket($catalogue, $deliveryRules, $offers);

$basket->add('G01');
$basket->add('R01');

echo "\n 1 G01 1 R01 Total: $" . $basket->total();


$basket = new Basket($catalogue, $deliveryRules, $offers);

$basket->add('G01');
$basket->add('B01');

echo "\n 1 G01 1 B01 Total: $" . $basket->total();

$basket = new Basket($catalogue, $deliveryRules, $offers);

$basket->add('R01');
$basket->add('R01');

echo "\n 2 R01 Total: $" . $basket->total();