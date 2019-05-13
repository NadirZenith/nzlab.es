<?php

namespace Templating\Helper;

/**
 */
class DummyHelper
{

    static protected $assets = [
        'https://ak4.picdn.net/shutterstock/videos/17833774/preview/stock-footage-canaries-serinus-canaria-eating-grain-from-a-bowl-with-blue-background.',
        'https://ak5.picdn.net/shutterstock/videos/23980015/preview/stock-footage-beautiful-of-grey-headed-canary-flycatcher-culicicapa-ceylonensis-bird-bird-taking-a-bath-in.',
        'https://ak7.picdn.net/shutterstock/videos/21246427/preview/stock-footage-island-dunes-gran-canary.',
        'https://ak8.picdn.net/shutterstock/videos/33708418/preview/stock-footage-cute-bird-standing-and-relaxing-rey-headed-canary-flycatcher.',
    ];


    public function __construct()
    {
    }


    public function dummy(string $modelClassName)
    {
    }

    public function dummyCollection(string $modelClassName, int $numItems = 20)
    {
    }

    public function dummyImage(int $width, int $height, string $title = null, string $alt = null)
    {
        return sprintf('<img src="%s" title="%s" alt="%s" />', $this->dummyImageSrc($width, $height), $title, $alt);
    }

    public function dummyImageSrc(int $width, int $height)
    {
        return sprintf('https://via.placeholder.com/%sx%s', $width, $height);
    }

    public function dummyVideo(int $width, int $height, $format)
    {
        return sprintf('<video src="%s" poster="%s" width="%s" height="%s" preload="none" controls />', $this->dummyVideoSrc($format), $this->dummyImageSrc($width, $height), $width, $height);
    }

    public function dummyVideoSrc(string $format)
    {
        return static::$assets[intval(floor(rand(0, 3)))] . $format;
    }

    public function dummyAudio(string $format)
    {
        return sprintf('<audio src="%s" />', $this->dummyAudioSrc($format));
    }

    public function dummyAudioSrc(string $format)
    {
        return static::$assets[intval(floor(rand(0, 3)))] . $format;
    }
}
