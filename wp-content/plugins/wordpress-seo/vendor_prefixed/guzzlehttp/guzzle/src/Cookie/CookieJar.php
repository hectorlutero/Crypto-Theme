<?php

namespace YoastSEO_Vendor\GuzzleHttp\Cookie;

use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
use YoastSEO_Vendor\Psr\Http\Message\ResponseInterface;
/**
 * Cookie jar that stores cookies as an array
 */
class CookieJar implements \YoastSEO_Vendor\GuzzleHttp\Cookie\CookieJarInterface
{
<<<<<<< HEAD
    /**
     * @var SetCookie[] Loaded cookie data
     */
    private $cookies = [];
    /**
     * @var bool
     */
    private $strictMode;
    /**
     * @param bool  $strictMode  Set to true to throw exceptions when invalid
=======
    /** @var SetCookie[] Loaded cookie data */
    private $cookies = [];
    /** @var bool */
    private $strictMode;
    /**
     * @param bool $strictMode   Set to true to throw exceptions when invalid
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     *                           cookies are added to the cookie jar.
     * @param array $cookieArray Array of SetCookie objects or a hash of
     *                           arrays that can be used with the SetCookie
     *                           constructor
     */
<<<<<<< HEAD
    public function __construct(bool $strictMode = \false, array $cookieArray = [])
=======
    public function __construct($strictMode = \false, $cookieArray = [])
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->strictMode = $strictMode;
        foreach ($cookieArray as $cookie) {
            if (!$cookie instanceof \YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie) {
                $cookie = new \YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie($cookie);
            }
            $this->setCookie($cookie);
        }
    }
    /**
     * Create a new Cookie jar from an associative array and domain.
     *
     * @param array  $cookies Cookies to create the jar from
     * @param string $domain  Domain to set the cookies to
<<<<<<< HEAD
     */
    public static function fromArray(array $cookies, string $domain) : self
=======
     *
     * @return self
     */
    public static function fromArray(array $cookies, $domain)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $cookieJar = new self();
        foreach ($cookies as $name => $value) {
            $cookieJar->setCookie(new \YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie(['Domain' => $domain, 'Name' => $name, 'Value' => $value, 'Discard' => \true]));
        }
        return $cookieJar;
    }
    /**
<<<<<<< HEAD
     * Evaluate if this cookie should be persisted to storage
     * that survives between requests.
     *
     * @param SetCookie $cookie              Being evaluated.
     * @param bool      $allowSessionCookies If we should persist session cookies
     */
    public static function shouldPersist(\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie, bool $allowSessionCookies = \false) : bool
=======
     * @deprecated
     */
    public static function getCookieValue($value)
    {
        return $value;
    }
    /**
     * Evaluate if this cookie should be persisted to storage
     * that survives between requests.
     *
     * @param SetCookie $cookie Being evaluated.
     * @param bool $allowSessionCookies If we should persist session cookies
     * @return bool
     */
    public static function shouldPersist(\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie, $allowSessionCookies = \false)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($cookie->getExpires() || $allowSessionCookies) {
            if (!$cookie->getDiscard()) {
                return \true;
            }
        }
        return \false;
    }
    /**
     * Finds and returns the cookie based on the name
     *
     * @param string $name cookie name to search for
<<<<<<< HEAD
     *
     * @return SetCookie|null cookie that was found or null if not found
     */
    public function getCookieByName(string $name) : ?\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie
    {
=======
     * @return SetCookie|null cookie that was found or null if not found
     */
    public function getCookieByName($name)
    {
        // don't allow a non string name
        if ($name === null || !\is_scalar($name)) {
            return null;
        }
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        foreach ($this->cookies as $cookie) {
            if ($cookie->getName() !== null && \strcasecmp($cookie->getName(), $name) === 0) {
                return $cookie;
            }
        }
        return null;
    }
<<<<<<< HEAD
    public function toArray() : array
    {
        return \array_map(static function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) : array {
            return $cookie->toArray();
        }, $this->getIterator()->getArrayCopy());
    }
    public function clear(string $domain = null, string $path = null, string $name = null) : void
=======
    public function toArray()
    {
        return \array_map(function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) {
            return $cookie->toArray();
        }, $this->getIterator()->getArrayCopy());
    }
    public function clear($domain = null, $path = null, $name = null)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!$domain) {
            $this->cookies = [];
            return;
        } elseif (!$path) {
<<<<<<< HEAD
            $this->cookies = \array_filter($this->cookies, static function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) use($domain) : bool {
                return !$cookie->matchesDomain($domain);
            });
        } elseif (!$name) {
            $this->cookies = \array_filter($this->cookies, static function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) use($path, $domain) : bool {
                return !($cookie->matchesPath($path) && $cookie->matchesDomain($domain));
            });
        } else {
            $this->cookies = \array_filter($this->cookies, static function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) use($path, $domain, $name) {
=======
            $this->cookies = \array_filter($this->cookies, function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) use($domain) {
                return !$cookie->matchesDomain($domain);
            });
        } elseif (!$name) {
            $this->cookies = \array_filter($this->cookies, function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) use($path, $domain) {
                return !($cookie->matchesPath($path) && $cookie->matchesDomain($domain));
            });
        } else {
            $this->cookies = \array_filter($this->cookies, function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) use($path, $domain, $name) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                return !($cookie->getName() == $name && $cookie->matchesPath($path) && $cookie->matchesDomain($domain));
            });
        }
    }
<<<<<<< HEAD
    public function clearSessionCookies() : void
    {
        $this->cookies = \array_filter($this->cookies, static function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) : bool {
            return !$cookie->getDiscard() && $cookie->getExpires();
        });
    }
    public function setCookie(\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) : bool
=======
    public function clearSessionCookies()
    {
        $this->cookies = \array_filter($this->cookies, function (\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) {
            return !$cookie->getDiscard() && $cookie->getExpires();
        });
    }
    public function setCookie(\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // If the name string is empty (but not 0), ignore the set-cookie
        // string entirely.
        $name = $cookie->getName();
        if (!$name && $name !== '0') {
            return \false;
        }
        // Only allow cookies with set and valid domain, name, value
        $result = $cookie->validate();
        if ($result !== \true) {
            if ($this->strictMode) {
                throw new \RuntimeException('Invalid cookie: ' . $result);
<<<<<<< HEAD
            }
            $this->removeCookieIfEmpty($cookie);
            return \false;
=======
            } else {
                $this->removeCookieIfEmpty($cookie);
                return \false;
            }
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        }
        // Resolve conflicts with previously set cookies
        foreach ($this->cookies as $i => $c) {
            // Two cookies are identical, when their path, and domain are
            // identical.
            if ($c->getPath() != $cookie->getPath() || $c->getDomain() != $cookie->getDomain() || $c->getName() != $cookie->getName()) {
                continue;
            }
            // The previously set cookie is a discard cookie and this one is
            // not so allow the new cookie to be set
            if (!$cookie->getDiscard() && $c->getDiscard()) {
                unset($this->cookies[$i]);
                continue;
            }
            // If the new cookie's expiration is further into the future, then
            // replace the old cookie
            if ($cookie->getExpires() > $c->getExpires()) {
                unset($this->cookies[$i]);
                continue;
            }
            // If the value has changed, we better change it
            if ($cookie->getValue() !== $c->getValue()) {
                unset($this->cookies[$i]);
                continue;
            }
            // The cookie exists, so no need to continue
            return \false;
        }
        $this->cookies[] = $cookie;
        return \true;
    }
<<<<<<< HEAD
    public function count() : int
    {
        return \count($this->cookies);
    }
    /**
     * @return \ArrayIterator<int, SetCookie>
     */
    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator(\array_values($this->cookies));
    }
    public function extractCookies(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response) : void
=======
    public function count()
    {
        return \count($this->cookies);
    }
    public function getIterator()
    {
        return new \ArrayIterator(\array_values($this->cookies));
    }
    public function extractCookies(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, \YoastSEO_Vendor\Psr\Http\Message\ResponseInterface $response)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($cookieHeader = $response->getHeader('Set-Cookie')) {
            foreach ($cookieHeader as $cookie) {
                $sc = \YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie::fromString($cookie);
                if (!$sc->getDomain()) {
                    $sc->setDomain($request->getUri()->getHost());
                }
                if (0 !== \strpos($sc->getPath(), '/')) {
                    $sc->setPath($this->getCookiePathFromRequest($request));
                }
                if (!$sc->matchesDomain($request->getUri()->getHost())) {
                    continue;
                }
                // Note: At this point `$sc->getDomain()` being a public suffix should
                // be rejected, but we don't want to pull in the full PSL dependency.
                $this->setCookie($sc);
            }
        }
    }
    /**
     * Computes cookie path following RFC 6265 section 5.1.4
     *
<<<<<<< HEAD
     * @see https://tools.ietf.org/html/rfc6265#section-5.1.4
     */
    private function getCookiePathFromRequest(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request) : string
=======
     * @link https://tools.ietf.org/html/rfc6265#section-5.1.4
     *
     * @param RequestInterface $request
     * @return string
     */
    private function getCookiePathFromRequest(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $uriPath = $request->getUri()->getPath();
        if ('' === $uriPath) {
            return '/';
        }
        if (0 !== \strpos($uriPath, '/')) {
            return '/';
        }
        if ('/' === $uriPath) {
            return '/';
        }
<<<<<<< HEAD
        $lastSlashPos = \strrpos($uriPath, '/');
        if (0 === $lastSlashPos || \false === $lastSlashPos) {
=======
        if (0 === ($lastSlashPos = \strrpos($uriPath, '/'))) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            return '/';
        }
        return \substr($uriPath, 0, $lastSlashPos);
    }
<<<<<<< HEAD
    public function withCookieHeader(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request) : \YoastSEO_Vendor\Psr\Http\Message\RequestInterface
=======
    public function withCookieHeader(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $values = [];
        $uri = $request->getUri();
        $scheme = $uri->getScheme();
        $host = $uri->getHost();
        $path = $uri->getPath() ?: '/';
        foreach ($this->cookies as $cookie) {
            if ($cookie->matchesPath($path) && $cookie->matchesDomain($host) && !$cookie->isExpired() && (!$cookie->getSecure() || $scheme === 'https')) {
                $values[] = $cookie->getName() . '=' . $cookie->getValue();
            }
        }
        return $values ? $request->withHeader('Cookie', \implode('; ', $values)) : $request;
    }
    /**
     * If a cookie already exists and the server asks to set it again with a
     * null value, the cookie must be deleted.
<<<<<<< HEAD
     */
    private function removeCookieIfEmpty(\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie) : void
=======
     *
     * @param SetCookie $cookie
     */
    private function removeCookieIfEmpty(\YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie $cookie)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $cookieValue = $cookie->getValue();
        if ($cookieValue === null || $cookieValue === '') {
            $this->clear($cookie->getDomain(), $cookie->getPath(), $cookie->getName());
        }
    }
}
