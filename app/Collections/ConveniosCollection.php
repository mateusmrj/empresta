<?php

namespace App\Collections;

use Illuminate\Support\Collection;

class ConveniosCollection 
{
    private $data;

    public function __construct()
    {
        $this->data = collect(
            [
                [
                    "chave" => "INSS",
                    "valor" => "INSS"
                ],
                [
                    "chave" => "FEDERAL",
                    "valor" => "Federal"
                ],
                [
                    "chave" => "SIAPE",
                    "valor" => "Siape"
                ]
            ]
        );
    }

    public function getConveniosCollection()
    {
        return Collection::make($this->data);
    }
}