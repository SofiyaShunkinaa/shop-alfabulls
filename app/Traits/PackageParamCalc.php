<?php

namespace App\Traits;

use App\Models\Basket;

Trait PackageParamCalc
{
    public function PackageParamCalc(Basket $basket)
    {
        $this->Length = 26;
        $this->Width = 20;
        $this->Height = 26;
        $this->Weight = 6500;
        $this->Amount = $basket->getAmount();
    }
}
