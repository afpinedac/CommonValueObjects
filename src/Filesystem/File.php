<?php

namespace Afpinedac\CommonValueObjects\Filesystem;

use InvalidArgumentException;

class File
{
    public readonly string $path;

    private function __construct(string $path)
    {
        $this->path = $path;
    }

    public static function from(?string $path): self
    {
        if ($path === null) {
            throw new InvalidArgumentException("The file path cannot be null.");
        }

        return new self($path);
    }

    public function validateExists(): void
    {
        if (!file_exists($this->path)) {
            throw new InvalidArgumentException("The file does not exist: {$this->path}");
        }

        if (!is_file($this->path)) {
            throw new InvalidArgumentException("The provided path is not a file: {$this->path}");
        }
    }

    public function getBasename(): string
    {
        return pathinfo($this->path, PATHINFO_BASENAME);
    }

    public function getFilename(): string
    {
        return pathinfo($this->path, PATHINFO_FILENAME);
    }

    public function getExtension(): ?string
    {
        return pathinfo($this->path, PATHINFO_EXTENSION) ?: null;
    }

    public function getDirectory(): string
    {
        return pathinfo($this->path, PATHINFO_DIRNAME);
    }

    public function equals(self $other): bool
    {
        return $this->path === $other->path;
    }

    public function __toString(): string
    {
        return $this->path;
    }
}