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
    expect($this->format_postal_code("T3C 1N"))->toBe("T3C 1N");
});
