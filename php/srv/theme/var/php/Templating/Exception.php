<?php


namespace Templating;

use RuntimeException;
use Throwable;

/**
 *
 */
class Exception extends RuntimeException
{

    /**
     * @param mixed      $template
     * @param Twig_Error $e
     *
     * @return Exception
     */
    static public function fromTwigError($template, Twig_Error $e): TemplatingException
    {
        return new static(sprintf('An error occurred while trying to render template "%s": %s', $template, $e->getMessage()), $e->getCode(), $e);
    }

    /**
     * @param mixed     $template
     * @param Throwable $t
     *
     * @return Exception
     */
    static public function fromThrowable($template, Throwable $t): TemplatingException
    {
        return new static(sprintf('An error occurred while trying to render template "%s": %s', $template, $t->getMessage()), $t->getCode(), $t);
    }
}