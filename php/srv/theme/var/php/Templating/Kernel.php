<?php

namespace Templating;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Templating\Extension\FrontendExtension;

/**
 * A thin extension over the Twig environment class.
 *
 */
class Kernel extends Application
{
    protected $template_path;

    protected $debug;

    public function __construct($template_path, $debug = false, array $values = [])
    {
        parent::__construct($values);

        $this->template_path = $template_path;
        $this->debug = $debug;


        $this['debug'] = $debug;
        $this->register(new TwigServiceProvider(), array(
            'twig.path' => $template_path,
            'cache'     => false,
        ));
        $this['twig']->addExtension(new FrontendExtension());
    }

    public function registerTemplatingRoues(array $mapping = [])
    {

        foreach ($mapping as $route => $map) {
            $this->get($route, function () use ($map) {
                return $this['twig']->render($map);
            });
        }

    }

}
