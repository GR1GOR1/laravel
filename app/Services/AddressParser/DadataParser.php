<?php

namespace App\Services\AddressParser;

use Dadata\DadataClient;

class DadataParser implements ParserInterface{
    public function __construct(protected DadataClient $dadata) {

    }
    public function clean(string $address) : array {
        // try-catch прописать
        return $this->dadata->clean("address", "мск сухонская 11 89");
    }
}