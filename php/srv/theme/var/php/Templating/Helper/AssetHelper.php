<?php

namespace Templating\Helper;

/**
 */
class AssetHelper
{

    /**
     * This should be defined in your .env file.
     *
     * @const string
     */
    const ENV_FRONTEND_AUTHORITY = 'WP_FRONTEND_AUTHORITY';

    /**
     * @var string | null
     */
    private $authority;

    /**
     * AssetHelper constructor.
     *
     * @param string | null $authority
     */
    public function __construct(string $authority = null)
    {
        if (null === $authority) {
            $authority = getenv(self::ENV_FRONTEND_AUTHORITY) ?? '';
        }

        $this->authority = $authority;
    }

    public function asset(string $path): string
    {
        return $this->authority . ltrim($path, '/');
    }

    public function uuid(): string
    {
        return uniqid(md5(time()));
    }

    public function image($metadata, string $size): string
    {
        $fallback = '/wp-content/uploads/' . $metadata['file'];

        if (!isset($metadata['sizes'])) {
            return $fallback;
        }

        if (!isset($metadata['sizes'][$size])) {
            return $fallback;
        }

        return dirname($fallback) . '/' . strval($metadata['sizes'][$size]['file']);
    }
}