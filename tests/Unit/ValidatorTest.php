<?php

use Core\Validator;

it('validates a string', function () {
    expect(Validator::string('foobar'))->toBeTrue();
    expect(Validator::string(false))->toBeFalse();
    expect(Validator::string(''))->toBeFalse();
});

it('validates a string with a min length', function () {
    expect(Validator::string('foobar', 20))->toBeFalse();
});

it('validates an email', function () {
    expect(Validator::email('email@gmail.com'))->toBeTrue();
    expect(Validator::email('not_an.email'))->toBeFalse();
    expect(Validator::email('some@crappy@gmail.com'))->toBeFalse();
});

it('validates that a number is greater than a given amount', function () {
    expect(Validator::greaterThan(10, 1))->toBeTrue();
    expect(Validator::greaterThan(10, 11))->toBeFalse();
    expect(Validator::greaterThan(10, 10))->toBeFalse();

});