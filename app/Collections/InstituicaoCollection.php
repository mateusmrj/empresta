<?php

namespace App\Collections;

use Illuminate\Support\Collection;

class InstituicaoCollection 
{
    private $data;

    public function __construct()
    {
        $this->data = collect(
            [
                [
                    "chave" => "PAN",
                    "valor" => "Pan"
                ],
                [
                    "chave" => "OLE",
                    "valor" => "Ole"
                ],
                [
                    "chave" => "BMG",
                    "valor" => "Bmg"
                ]
            ]
        );
    }

    public function getInstituicaoCollection()
    {
        return Collection::make($this->data);
    }
}