<?php

namespace Shawnveltman\Texthelpers;

use Illuminate\Support\Str;

trait TextTrait
{
    public function stripEverythingButNumbersAndPeriods($inputValue): string|null
    {
        $value = preg_replace('/[^0-9.]/', '', $inputValue);

        if ($value === '') {
            return null;
        }

        return $value;
    }

    public function stripEverythingButNumbers($inputValue): string|null
    {
        $value = preg_replace('/\D/', '', $inputValue);

        if ($value === '') {
            return null;
        }

        return $value;
    }

    public function money_from_cents($amount_in_cents): string
    {
        return '$' . number_format($amount_in_cents / 100, 2);
    }

    public function money_from_dollars($amount_in_dollars): string
    {
        return '$' . number_format($amount_in_dollars, 2);
    }

    #[Pure]
    public function format_phone_number($phone_number_string): string
    {
        $ten_digit_phone_number = $this->get_ten_digit_phone_number($phone_number_string);

        if (strlen($ten_digit_phone_number) === 11) {
            $ten_digit_phone_number = Str::substr($ten_digit_phone_number, 1);
        }

        $area_code = Str::substr($ten_digit_phone_number, 0, 3);
        $middle = Str::substr($ten_digit_phone_number, 3, 3);
        $end = Str::substr($ten_digit_phone_number, 6);

        return "({$area_code}) {$middle}-{$end}";
    }

    public function get_twilio_formatted_number($phone_number): string
    {
        $ten_digit_number = $this->get_ten_digit_phone_number($phone_number);

        return '+1' . $ten_digit_number;
    }

    public function get_ten_digit_phone_number(string $phone_number): string
    {
        $phone_number = Str::replace(['-', ' ', '(', ')', '+'], '', $phone_number);

        if (Str::startsWith($phone_number, '1')) {
            $phone_number = Str::substr($phone_number, 1);
        }

        return $phone_number;
    }

    public function format_postal_code(string $value): string
    {
        $normalized = Str::replace(' ', '', $value);

        if (Str::length($normalized) > 5) {
            $first_part = Str::substr($normalized, 0, 3);
            $second_part = Str::substr($normalized, 3);

            return $first_part . ' ' . $second_part;
        }

        return $value;
    }
}
