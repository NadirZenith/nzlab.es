<?php

namespace Templating;


use Templating\Extension\FrontendExtension;
use Throwable;

use Twig_Environment;
use Twig_Error_Loader;
use Twig_Error_Syntax;
use Twig_Error_Runtime;
use Twig_Loader_Filesystem;

/**
 * A thin wrapper over the Twig environment class.
 *
 */
class Templating
{

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var array
     */
    private $defaultContext;


    /**
     * Templating constructor.
     *
     * @param string               $templateDir
     * @param array<string, mixed> $options
     */
    public function __construct(string $templateDir, array $options = null)
    {
        if (! file_exists($templateDir)) {
            throw new Exception(sprintf('Template directory "%s" does not exist.', $templateDir));
        }

        if (! is_dir($templateDir)) {
            throw new Exception(sprintf('Template directory "%s" is not a directory.', $templateDir));
        }

        if (! is_readable($templateDir)) {
            throw new Exception(sprintf('Template directory "%s" is not readable.', $templateDir));
        }

        if (null === $options) {
            $options = [
                'cache' => false,
            ];
        }

        if (isset($options['cache']) && $options['cache']) {
            $cacheDir = $options['cache'];

            if (! file_exists(dirname($cacheDir))) {
                throw new Exception(sprintf('Cache directory "%s" does not exist.', $cacheDir));
            }

            if (! is_writable(dirname($cacheDir))) {
                throw new Exception(sprintf('Cache directory "%s" is not writable.', $templateDir));
            }
        }

        $this->twig = new Twig_Environment(new Twig_Loader_Filesystem($templateDir), $options);
        $this->twig->addExtension(new FrontendExtension());
        $this->defaultContext = [];
    }

    /**
     * Renders a template.
     *
     * @param string $template the template name, relative to the template directory
     * @param array  $context  the context (a map of variables) to use when rendering the template
     *
     * @return string
     */
    public function render(string $template, array $context = []): string
    {
        $context = array_merge($this->getDefaultTemplateContext(), $context);

        try {
            return $this->twig->render($template, $context);
        } catch (Twig_Error_Loader $e) {
            throw Exception::fromTwigError($template, $e);

        } catch (Twig_Error_Syntax $f) {
            throw Exception::fromTwigError($template, $f);

        } catch (Twig_Error_Runtime $g) {
            throw Exception::fromTwigError($template, $g);

        } catch (Throwable $t) {
            throw Exception::fromThrowable($template, $t);
        }
    }

    /**
     * Returns the default template context, which is always available in all
     * templates.
     *
     * @return array
     */
    public function getDefaultTemplateContext(): array
    {
        return $this->defaultContext;
    }

    /**
     * Adds an entry to the default template context, which is always
     * available in all templates.
     *
     * @param string $key
     * @param mixed  $data
     *
     * @return Templating chainable
     */
    public function addDefaultTemplateContext(string $key, $data): Templating
    {
        $this->defaultContext[$key] = $data;

        return $this;
    }

    /**
     * Sets the default template context, which is always available in all
     * templates.
     *
     * @param array<string, mixed> $context
     *
     * @return Templating chainable
     */
    public function setDefaultTemplateContext(array $context): Templating
    {
        $this->defaultContext = $context;

        return $this;
    }

    /**
     * Tests whether Wordpress is currently handling an AJAX request.
     *
     * @return bool
     */
    protected function isAjax(): bool
    {
        return defined('DOING_AJAX') && DOING_AJAX;
    }
}
