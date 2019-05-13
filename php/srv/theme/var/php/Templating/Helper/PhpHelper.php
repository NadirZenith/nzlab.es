<?php

namespace Templating\Helper;

/**
 */
class PhpHelper
{

    protected function parseFullyQualifiedClassName($obj)
    {
        if (! is_object($obj)) {
            return ['', gettype($obj)];
        }

        $class = get_class($obj);

        if (false === ($offset = strrpos($class, '\\'))) {
            return ['', $class];
        }

        return [
            substr($class, 0, $offset),
            substr($class, $offset + 1),
        ];
    }

    public function phpClassName($obj): string
    {
        return is_object($obj) ? get_class($obj) : gettype($obj);
    }

    public function phpShortClassName($obj): string
    {
        list ($namespace, $className) = $this->parseFullyQualifiedClassName($obj);

        return $className;
    }

    public function phpNamespaceName($obj): string
    {
        list ($namespace, ) = $this->parseFullyQualifiedClassName($obj);

        return $namespace;
    }

    public function phpGlobals(): array
    {
        return $GLOBALS;
    }

    public function phpGlobalGet(): array
    {
        return $_GET;
    }

    public function phpGlobalPost(): array
    {
        return $_POST;
    }

    public function phpGlobalFiles(): array
    {
        return $_FILES;
    }

    public function phpGlobalRequest(): array
    {
        return $_REQUEST;
    }

    public function phpGlobalServer(): array
    {
        return $_SERVER;
    }
}