<?php
namespace OnCallManager;

class Customer
{
    private $credentials;

    public function __construct($credentials)
    {
    }

    public function credentials()
    {
        return $this->credentials;
    }
}