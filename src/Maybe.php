<?php

namespace Alura\Fp;

class Maybe
{
    private mixed $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function of($valor)
    {
        return new self($valor);
    }

    public function isNothing()
    {
        return $this->value === null;
    }

    public function getOrElse($default)
    {
        return $this->isNothing() ? $default : $this->value;
    }

    public function map(callable $fn)
    {
        if ($this->isNothing()) {
            return Maybe::of($this->value);
        }

        $value = $fn($this->value);

        return Maybe::of($valor);
    }
}
