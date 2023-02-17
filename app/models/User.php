<?php

class User
{
    public int $id;
    public string $email;
    public ?string $password;
    public ?string $first_name;
    public ?string $last_name;
    public ?string $address;
    public ?string $address_optional;
    public ?string $city;
    public ?string $state;
    public ?string $postal_code;
    public ?string $country;
    public ?string $phone_number;
    public int $is_admin;
}
