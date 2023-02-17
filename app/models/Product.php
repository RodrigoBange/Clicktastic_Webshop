<?php

class Product
{
    public int $id;
    public string $name;
    public string $description;
    public $price;
    public string $company;
    public string $size;
    public int $amountKeys;
    public string $layout;
    public string $backlit;
    public bool $hotswap;
    public string $color;
    public string $material;
    public string $switches;
    public ?string $image;
    public ?int $quantity;
}
