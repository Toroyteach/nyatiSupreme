<?php

namespace App\Contracts;

interface MpesaContract
{
    public function c2bsimulate($params);

    public function stksimulate($params);

    public function pesapalcreate($params);

}