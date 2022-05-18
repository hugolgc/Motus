<?php

declare(strict_types=1);

class cleanCode
{
    public function save(string $name, self $value): void
    {
        setcookie($name, serialize($value));
    }

    public function load(string $name): mixed
    {
        return unserialize($_COOKIE[$name]);
    }
}
