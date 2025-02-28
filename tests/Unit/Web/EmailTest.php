<?php

namespace Tests\Unit\Web;

use Afpinedac\CommonValueObjects\Web\Email;

describe('Email Value Object', function () {

    it('can create an email object from a valid email', function () {
        $email = Email::from('example@example.com');
        expect((string) $email)->toBe('example@example.com');
    });

    it('throws exception for invalid email', function () {
        expect(fn () => Email::from('invalid-email'))->toThrow(\InvalidArgumentException::class, 'The provided value is not a valid email address.');
    });

    it('throws exception for null email', function () {
        expect(fn () => Email::from(null))->toThrow(\InvalidArgumentException::class, 'Email cannot be null.');
    });

    it('can get the domain part of a valid email', function () {
        $email = Email::from('user@domain.com');
        expect($email->getDomain())->toBe('domain.com');
    });

    it('returns true when two email objects are equal', function () {
        $email1 = Email::from('example@example.com');
        $email2 = Email::from('example@example.com');

        expect($email1->equals($email2))->toBeTrue();
    });

    it('returns false when two email objects are not equal', function () {
        $email1 = Email::from('example@example.com');
        $email2 = Email::from('other@example.com');

        expect($email1->equals($email2))->toBeFalse();
    });

    it('can convert the email object to a string', function () {
        $email = Email::from('example@example.com');
        expect((string) $email)->toBe('example@example.com');
    });

});
