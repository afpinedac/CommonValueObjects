<?php

namespace Afpinedac\CommonValueObjects\Tests\Unit\Numeric;

use Afpinedac\CommonValueObjects\Numeric\Percentage;

describe('Percentage Value Object', function () {

    it('can create a percentage instance', function () {
        $percentage = new Percentage(0.25);
        expect($percentage->value)->toBe(0.25);
    });

    it('can create a percentage from a static method', function () {
        $percentage = Percentage::from(0.50);
        expect($percentage)->toBeInstanceOf(Percentage::class);
        expect($percentage->value)->toBe(0.50);
    });

    it('returns formatted percentage', function () {
        $percentage = new Percentage(0.1234);
        expect($percentage->getFormatted())->toBe('12.34%');
    });

    it('returns an empty string if value is null', function () {
        $percentage = new Percentage(null);
        expect($percentage->getFormatted())->toBe('');
    });

    it('formats percentage with a custom symbol', function () {
        $percentage = new Percentage(0.075);
        expect($percentage->getFormatted())->toBe('7.50%');
    });

});