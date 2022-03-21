<?php

namespace App\Helpers;

class CurrencyHelper {
    public static function rupiah($amount)
    {
        return 'Rp' . number_format($amount, 0, ',', '.');
    }
}
