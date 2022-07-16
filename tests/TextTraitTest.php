<?php

use Shawnveltman\Texthelpers\TextTrait;

uses(TextTrait::class);

it('can convert a phone number to digits only', function ($phone_number) {
    expect($this->get_ten_digit_phone_number($phone_number))->toEqual('2345678900');
})->with([
    'already_good' => '2345678900',
    'includes_one' => '12345678900',
    'with_dashes' => '1-234-567-8900',
    'with_spaces' => '1 234 567-8900',
    'with_parenthesis' => '1 (234) 567-8900',
    'with_plus_sign' => '+1 (234) 567-8900',
]);

it('can strip everything but numbers and periods', function () {
    expect($this->stripEverythingButNumbersAndPeriods("AB123CDE.45"))->toEqual(123.45);
});

it('returns null when stripping everything but numbers and periods if there are no numbers or periods', function () {
    expect($this->stripEverythingButNumbersAndPeriods("ABCDEFghi"))->toBeNull();
});

it('can strip everything but numbers', function () {
    expect($this->stripEverythingButNumbers("AB123CDE.45"))->toEqual(12345);
});

it('returns null when stripping everything but numbers if there are no numbers or periods', function () {
    expect($this->stripEverythingButNumbers("ABCDEFghi."))->toBeNull();
});

it('Can convert integer to dollars string (from cents)', function () {
    expect($this->money_from_cents(12345))->toBe("$123.45");
});

it('Can convert integer to dollars string', function () {
    expect($this->money_from_dollars(123.45))->toBe("$123.45");
});

it('Rounds dollars down to nearest cent if there are more than 2 points of precision', function () {
    expect($this->money_from_dollars(123.453))->toBe("$123.45");
});

it('Rounds dollars up to nearest cent if there are more than 2 points of precision', function () {
    expect($this->money_from_dollars(123.458))->toBe("$123.46");
});

it('formats ten digit phone number for display', function () {
    expect($this->format_phone_number("12345678901"))->toBe("(234) 567-8901");
});

it('adds a +1 to phone number for Twilio', function () {
    expect($this->get_twilio_formatted_number(2345678901))->toBe("+12345678901");
});

it('formats a string as a postal code when it has 6 characters', function () {
    expect($this->format_postal_code("T3C1N2"))->toBe("T3C 1N2");
});

it('formats a string as a postal code when it has 6 characters and a space', function () {
    expect($this->format_postal_code("T3C 1N2"))->toBe("T3C 1N2");
});

it('does not add space in postal code when there are less than 6 characters', function () {
    expect($this->format_postal_code("T3C1N"))->toBe("T3C1N");
});

it('can strip everything except letters from a string to prepare it for email', function () {
    expect($this->create_email_address("Shawn O'Veltman12", 'test.com'))->toBe('shawnoveltman@test.com');
});

it('can sanitize emails to strip out the from name', function () {
    $input_email = "Shawn Veltman <shawn.veltman@gmail.com>";
    expect($this->sanitize_email_address($input_email))->toBe('shawn.veltman@gmail.com');
});

it('returns valid email from sanitation if there are no <> strings', function () {
    expect($this->sanitize_email_address('shawn.veltman@gmail.com'))->toBe('shawn.veltman@gmail.com');
});

it('can find an email address within a string when sanitizing it', function () {
    $email_address = "sha-wn.veltman@test.com";
    $input_email = "this is a tricky one that hides the email ({$email_address}) within a larger string";
    expect($this->sanitize_email_address($input_email))->toBe($email_address);
});

it('gets a GIS point string from a given lat & lng', function () {
    expect($this->get_gis_point_string(lat: 45.5, lng: -75.5))->toBe('POINT(-75.5 45.5)');
});
