<?php

namespace App\Services\AddressParser;

interface ParserInterface {
    public function clean(string $address) : array;
}