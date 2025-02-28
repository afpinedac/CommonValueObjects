<?php

namespace Afpinedac\CommonValueObjects\Web;

use InvalidArgumentException;

class Email
{
    public readonly string $value;

    private function __construct(string $email)
    {
        $this->ensureIsValidEmail($email);
        $this->value = $email;
    }

    public static function from(?string $email): self
    {
        if ($email === null) {
            throw new InvalidArgumentException('Email cannot be null.');
        }

        return new self($email);
    }

    private function ensureIsValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('The provided value is not a valid email address.');
        }
    }

    public function getDomain(): string
    {
        return substr(strrchr($this->value, '@'), 1);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}