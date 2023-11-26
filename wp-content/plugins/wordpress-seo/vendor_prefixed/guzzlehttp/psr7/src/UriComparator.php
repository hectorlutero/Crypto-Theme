<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\UriInterface;
/**
 * Provides methods to determine if a modified URL should be considered cross-origin.
 *
 * @author Graham Campbell
 */
final class UriComparator
{
    /**
     * Determines if a modified URL should be considered cross-origin with
     * respect to an original URL.
<<<<<<< HEAD
     */
    public static function isCrossOrigin(\YoastSEO_Vendor\Psr\Http\Message\UriInterface $original, \YoastSEO_Vendor\Psr\Http\Message\UriInterface $modified) : bool
=======
     *
     * @return bool
     */
    public static function isCrossOrigin(\YoastSEO_Vendor\Psr\Http\Message\UriInterface $original, \YoastSEO_Vendor\Psr\Http\Message\UriInterface $modified)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (\strcasecmp($original->getHost(), $modified->getHost()) !== 0) {
            return \true;
        }
        if ($original->getScheme() !== $modified->getScheme()) {
            return \true;
        }
        if (self::computePort($original) !== self::computePort($modified)) {
            return \true;
        }
        return \false;
    }
<<<<<<< HEAD
    private static function computePort(\YoastSEO_Vendor\Psr\Http\Message\UriInterface $uri) : int
=======
    /**
     * @return int
     */
    private static function computePort(\YoastSEO_Vendor\Psr\Http\Message\UriInterface $uri)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $port = $uri->getPort();
        if (null !== $port) {
            return $port;
        }
        return 'https' === $uri->getScheme() ? 443 : 80;
    }
    private function __construct()
    {
        // cannot be instantiated
    }
}
