<?php

namespace Afpinedac\CommonValueObjects\Web;

use InvalidArgumentException;

class Url
{
    public readonly ?string $value;

    public function __construct(?string $value)
    {
        $this->ensureIsValidURL($value);
        $this->value = $value;
    }

    public static function from(?string $value): self
    {
        return new self($value);
    }

    private function ensureIsValidURL(?string $value): void
    {
        if ($value === null) {
            return;
        }

        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("The provided value is not a valid URL.");
        }
    }

    private function getPart(int $component): ?string
    {
        if ($this->value === null) {
            return null;
        }

        return parse_url($this->value, $component) ?: null;
    }

    public function getScheme(): ?string
    {
        return $this->getPart(PHP_URL_SCHEME);
    }

    public function getDomain(): ?string
    {
        return $this->getPart(PHP_URL_HOST);
    }

    public function getTopLevelDomain(): ?string
    {
        $domain = $this->getDomain();
        if ($domain === null) {
            return null;
        }

        $parts = explode('.', $domain);
        return count($parts) > 1 ? end($parts) : null;
    }

    public function getSubdomain(): ?string
    {
        $domain = $this->getDomain();
        if ($domain === null) {
            return null;
        }

        $parts = explode('.', $domain);
        // If there are 3 or more parts (e.g., sub.example.com), the subdomain exists.
        return count($parts) > 2 ? array_shift($parts) : null;
    }

    public function isHttp(): bool
    {
        return $this->getScheme() === 'http';
    }

    public function isHttps(): bool
    {
        return $this->getScheme() === 'https';
    }

    public function getPath(): ?string
    {
        return $this->getPart(PHP_URL_PATH);
    }

    public function getQueryString(): ?string
    {
        return $this->getPart(PHP_URL_QUERY);
    }

    public function getFragment(): ?string
    {
        return $this->getPart(PHP_URL_FRAGMENT);
    }

    public function getPort(): ?int
    {
        $port = $this->getPart(PHP_URL_PORT);
        return $port !== null ? (int) $port : null;
    }

    public function getUser(): ?string
    {
        return $this->getPart(PHP_URL_USER);
    }

    public function getPassword(): ?string
    {
        return $this->getPart(PHP_URL_PASS);
    }

    public function __toString(): string
    {
        return $this->value ?? '';
    }
}