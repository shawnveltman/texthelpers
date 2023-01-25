<?php

namespace Shawnveltman\Texthelpers;

use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

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
        $phone_number = $this->stripEverythingButNumbers($phone_number) ?? '';

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

    public function strip_everything_but_letters(string $string)
    {
        return preg_replace("/[^a-zA-Z]/", "", $string);
    }

    public function create_email_address(string $name, string $domain)
    {
        $formatted_name = strtolower($this->strip_everything_but_letters($name));
        $formatted_domain = strtolower($domain);

        return "{$formatted_name}@{$formatted_domain}";
    }

    public function sanitize_email_address(string $input_email)
    {
        $input_array = collect(explode(" ", $input_email));
        $email_string = '';
        foreach ($input_array as $string) {
            ray($string);
            if (Str::contains($string, '@') && strlen($string) > 5) {
                $email_string = $string;

                break;
            }
        }

        if ($email_string === '') {
            return '';
        }

        return Str::replace(['<','>','(',')'], '', $email_string);
    }

    public function remove_utf8_bom($text)
    {
        $bom = pack('H*', 'EFBBBF');

        return preg_replace("/^{$bom}/", '', $text);
    }

    public function get_gis_point_string(float|string $lat, float|string $lng)
    {
        return "POINT({$lng} {$lat})";
    }

    #[ArrayShape(['lat' => 'float', 'lng' => 'float'])]
    public function get_gis_point_array(string $point_string): array
    {
        if (! $point_string) {
            return [
                'lat' => 0,
                'lng' => 0,
            ];
        }

        $new_string = str_replace(['POINT', '(', ')'], '', $point_string);
        $point_array = explode(' ', $new_string);

        return [
            'lat' => (float)$point_array[1],
            'lng' => (float)$point_array[0],
        ];
    }

    public function get_gis_bounding_box_from_top_left_and_bottom_right_points(array $top_left_point, array $bottom_right_point)
    {
        $top_left_string = $top_left_point['lng'] . ' ' . $top_left_point['lat'];
        $top_right_string = $bottom_right_point['lng'] . ' ' . $top_left_point['lat'];
        $bottom_right_string = $bottom_right_point['lng'] . ' ' . $bottom_right_point['lat'];
        $bottom_left_string = $top_left_point['lng'] . ' ' . $bottom_right_point['lat'];

        return "MULTIPOLYGON((({$top_left_string},{$top_right_string},{$bottom_right_string},{$bottom_left_string},{$top_left_string})))";
    }

    public function is_empty_or_null(?string $value)
    {
        $value = trim($value);
        return $value === '' || $value === null;
    }


}
