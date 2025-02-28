<?php


namespace Afpinedac\CommonValueObjects\Numeric;

class Percentage
{
    public readonly ?float $value;

    public function __construct(?float $value)
    {
        $this->value = $value;
    }

    public static function from(?float $value): self
    {
        return new self($value);
    }

    public function getFormatted(): string
    {
        if ($this->value === null) {
            return '';
        } else {
            return number_format($this->value * 100, 2) . '%';
        }
    }

}