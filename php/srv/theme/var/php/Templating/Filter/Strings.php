<?php

namespace Templating\Filter;

class Strings
{

    public function lcfirst(string $that): string
    {
        return lcfirst($that);
    }

    public function ucfirst(string $that): string
    {
        return ucfirst($that);
    }

    public function ltrim(string $that, $chars = null): string
    {
        return ltrim($that, $chars);
    }

    public function rtrim(string $that, $chars = null): string
    {
        return rtrim($that, $chars);
    }
}