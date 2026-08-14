<?php

declare(strict_types=1);

namespace App\Concerns;

trait FormatsWhatsAppNumber
{
    protected function formatWhatsAppNumber(string $number): string
    {
        $number = preg_replace('/[^0-9]/', '', $number);

        if (str_starts_with($number, '08')) {
            $number = '62' . substr($number, 1);
        }

        if (str_starts_with($number, '628')) {
            return $number;
        }

        if (str_starts_with($number, '62')) {
            return $number;
        }

        return '62' . $number;
    }
}
