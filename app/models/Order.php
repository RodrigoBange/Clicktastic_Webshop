<?php
require_once(__DIR__ . "/../models/Product.php");

class Order
{
    public int $id;
    public string $order_date;
    public string $address;
    public ?string $address_optional;
    public string $city;
    public string $state;
    public string $postal_code;
    public string $country;
    public string $phone_number;
    public $total;
    public ?array $products;
}
