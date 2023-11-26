<?php

namespace YoastSEO_Vendor\GuzzleHttp\Cookie;

/**
 * Set-Cookie object
 */
class SetCookie
{
<<<<<<< HEAD
    /**
     * @var array
     */
    private static $defaults = ['Name' => null, 'Value' => null, 'Domain' => null, 'Path' => '/', 'Max-Age' => null, 'Expires' => null, 'Secure' => \false, 'Discard' => \false, 'HttpOnly' => \false];
    /**
     * @var array Cookie data
     */
    private $data;
    /**
     * Create a new SetCookie object from a string.
     *
     * @param string $cookie Set-Cookie header string
     */
    public static function fromString(string $cookie) : self
=======
    /** @var array */
    private static $defaults = ['Name' => null, 'Value' => null, 'Domain' => null, 'Path' => '/', 'Max-Age' => null, 'Expires' => null, 'Secure' => \false, 'Discard' => \false, 'HttpOnly' => \false];
    /** @var array Cookie data */
    private $data;
    /**
     * Create a new SetCookie object from a string
     *
     * @param string $cookie Set-Cookie header string
     *
     * @return self
     */
    public static function fromString($cookie)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // Create the default return array
        $data = self::$defaults;
        // Explode the cookie string using a series of semicolons
        $pieces = \array_filter(\array_map('trim', \explode(';', $cookie)));
        // The name of the cookie (first kvp) must exist and include an equal sign.
<<<<<<< HEAD
        if (!isset($pieces[0]) || \strpos($pieces[0], '=') === \false) {
=======
        if (empty($pieces[0]) || !\strpos($pieces[0], '=')) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            return new self($data);
        }
        // Add the cookie pieces into the parsed data array
        foreach ($pieces as $part) {
            $cookieParts = \explode('=', $part, 2);
            $key = \trim($cookieParts[0]);
            $value = isset($cookieParts[1]) ? \trim($cookieParts[1], " \n\r\t\x00\v") : \true;
            // Only check for non-cookies when cookies have been found
<<<<<<< HEAD
            if (!isset($data['Name'])) {
=======
            if (empty($data['Name'])) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                $data['Name'] = $key;
                $data['Value'] = $value;
            } else {
                foreach (\array_keys(self::$defaults) as $search) {
                    if (!\strcasecmp($search, $key)) {
<<<<<<< HEAD
                        if ($search === 'Max-Age') {
                            if (\is_numeric($value)) {
                                $data[$search] = (int) $value;
                            }
                        } else {
                            $data[$search] = $value;
                        }
=======
                        $data[$search] = $value;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
                        continue 2;
                    }
                }
                $data[$key] = $value;
            }
        }
        return new self($data);
    }
    /**
     * @param array $data Array of cookie data provided by a Cookie parser
     */
    public function __construct(array $data = [])
    {
<<<<<<< HEAD
        $this->data = self::$defaults;
        if (isset($data['Name'])) {
            $this->setName($data['Name']);
        }
        if (isset($data['Value'])) {
            $this->setValue($data['Value']);
        }
        if (isset($data['Domain'])) {
            $this->setDomain($data['Domain']);
        }
        if (isset($data['Path'])) {
            $this->setPath($data['Path']);
        }
        if (isset($data['Max-Age'])) {
            $this->setMaxAge($data['Max-Age']);
        }
        if (isset($data['Expires'])) {
            $this->setExpires($data['Expires']);
        }
        if (isset($data['Secure'])) {
            $this->setSecure($data['Secure']);
        }
        if (isset($data['Discard'])) {
            $this->setDiscard($data['Discard']);
        }
        if (isset($data['HttpOnly'])) {
            $this->setHttpOnly($data['HttpOnly']);
        }
        // Set the remaining values that don't have extra validation logic
        foreach (\array_diff(\array_keys($data), \array_keys(self::$defaults)) as $key) {
            $this->data[$key] = $data[$key];
        }
=======
        $this->data = \array_replace(self::$defaults, $data);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        // Extract the Expires value and turn it into a UNIX timestamp if needed
        if (!$this->getExpires() && $this->getMaxAge()) {
            // Calculate the Expires date
            $this->setExpires(\time() + $this->getMaxAge());
<<<<<<< HEAD
        } elseif (null !== ($expires = $this->getExpires()) && !\is_numeric($expires)) {
            $this->setExpires($expires);
=======
        } elseif ($this->getExpires() && !\is_numeric($this->getExpires())) {
            $this->setExpires($this->getExpires());
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        }
    }
    public function __toString()
    {
<<<<<<< HEAD
        $str = $this->data['Name'] . '=' . ($this->data['Value'] ?? '') . '; ';
=======
        $str = $this->data['Name'] . '=' . $this->data['Value'] . '; ';
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        foreach ($this->data as $k => $v) {
            if ($k !== 'Name' && $k !== 'Value' && $v !== null && $v !== \false) {
                if ($k === 'Expires') {
                    $str .= 'Expires=' . \gmdate('D, d M Y H:i:s \\G\\M\\T', $v) . '; ';
                } else {
                    $str .= ($v === \true ? $k : "{$k}={$v}") . '; ';
                }
            }
        }
        return \rtrim($str, '; ');
    }
<<<<<<< HEAD
    public function toArray() : array
=======
    public function toArray()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->data;
    }
    /**
<<<<<<< HEAD
     * Get the cookie name.
=======
     * Get the cookie name
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     *
     * @return string
     */
    public function getName()
    {
        return $this->data['Name'];
    }
    /**
<<<<<<< HEAD
     * Set the cookie name.
     *
     * @param string $name Cookie name
     */
    public function setName($name) : void
    {
        if (!\is_string($name)) {
            trigger_deprecation('guzzlehttp/guzzle', '7.4', 'Not passing a string to %s::%s() is deprecated and will cause an error in 8.0.', __CLASS__, __FUNCTION__);
        }
        $this->data['Name'] = (string) $name;
    }
    /**
     * Get the cookie value.
     *
     * @return string|null
=======
     * Set the cookie name
     *
     * @param string $name Cookie name
     */
    public function setName($name)
    {
        $this->data['Name'] = $name;
    }
    /**
     * Get the cookie value
     *
     * @return string
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function getValue()
    {
        return $this->data['Value'];
    }
    /**
<<<<<<< HEAD
     * Set the cookie value.
     *
     * @param string $value Cookie value
     */
    public function setValue($value) : void
    {
        if (!\is_string($value)) {
            trigger_deprecation('guzzlehttp/guzzle', '7.4', 'Not passing a string to %s::%s() is deprecated and will cause an error in 8.0.', __CLASS__, __FUNCTION__);
        }
        $this->data['Value'] = (string) $value;
    }
    /**
     * Get the domain.
=======
     * Set the cookie value
     *
     * @param string $value Cookie value
     */
    public function setValue($value)
    {
        $this->data['Value'] = $value;
    }
    /**
     * Get the domain
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     *
     * @return string|null
     */
    public function getDomain()
    {
        return $this->data['Domain'];
    }
    /**
<<<<<<< HEAD
     * Set the domain of the cookie.
     *
     * @param string|null $domain
     */
    public function setDomain($domain) : void
    {
        if (!\is_string($domain) && null !== $domain) {
            trigger_deprecation('guzzlehttp/guzzle', '7.4', 'Not passing a string or null to %s::%s() is deprecated and will cause an error in 8.0.', __CLASS__, __FUNCTION__);
        }
        $this->data['Domain'] = null === $domain ? null : (string) $domain;
    }
    /**
     * Get the path.
=======
     * Set the domain of the cookie
     *
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->data['Domain'] = $domain;
    }
    /**
     * Get the path
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     *
     * @return string
     */
    public function getPath()
    {
        return $this->data['Path'];
    }
    /**
<<<<<<< HEAD
     * Set the path of the cookie.
     *
     * @param string $path Path of the cookie
     */
    public function setPath($path) : void
    {
        if (!\is_string($path)) {
            trigger_deprecation('guzzlehttp/guzzle', '7.4', 'Not passing a string to %s::%s() is deprecated and will cause an error in 8.0.', __CLASS__, __FUNCTION__);
        }
        $this->data['Path'] = (string) $path;
    }
    /**
     * Maximum lifetime of the cookie in seconds.
=======
     * Set the path of the cookie
     *
     * @param string $path Path of the cookie
     */
    public function setPath($path)
    {
        $this->data['Path'] = $path;
    }
    /**
     * Maximum lifetime of the cookie in seconds
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     *
     * @return int|null
     */
    public function getMaxAge()
    {
<<<<<<< HEAD
        return null === $this->data['Max-Age'] ? null : (int) $this->data['Max-Age'];
    }
    /**
     * Set the max-age of the cookie.
     *
     * @param int|null $maxAge Max age of the cookie in seconds
     */
    public function setMaxAge($maxAge) : void
    {
        if (!\is_int($maxAge) && null !== $maxAge) {
            trigger_deprecation('guzzlehttp/guzzle', '7.4', 'Not passing an int or null to %s::%s() is deprecated and will cause an error in 8.0.', __CLASS__, __FUNCTION__);
        }
        $this->data['Max-Age'] = $maxAge === null ? null : (int) $maxAge;
    }
    /**
     * The UNIX timestamp when the cookie Expires.
     *
     * @return string|int|null
=======
        return $this->data['Max-Age'];
    }
    /**
     * Set the max-age of the cookie
     *
     * @param int $maxAge Max age of the cookie in seconds
     */
    public function setMaxAge($maxAge)
    {
        $this->data['Max-Age'] = $maxAge;
    }
    /**
     * The UNIX timestamp when the cookie Expires
     *
     * @return mixed
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function getExpires()
    {
        return $this->data['Expires'];
    }
    /**
<<<<<<< HEAD
     * Set the unix timestamp for which the cookie will expire.
     *
     * @param int|string|null $timestamp Unix timestamp or any English textual datetime description.
     */
    public function setExpires($timestamp) : void
    {
        if (!\is_int($timestamp) && !\is_string($timestamp) && null !== $timestamp) {
            trigger_deprecation('guzzlehttp/guzzle', '7.4', 'Not passing an int, string or null to %s::%s() is deprecated and will cause an error in 8.0.', __CLASS__, __FUNCTION__);
        }
        $this->data['Expires'] = null === $timestamp ? null : (\is_numeric($timestamp) ? (int) $timestamp : \strtotime((string) $timestamp));
    }
    /**
     * Get whether or not this is a secure cookie.
     *
     * @return bool
=======
     * Set the unix timestamp for which the cookie will expire
     *
     * @param int $timestamp Unix timestamp
     */
    public function setExpires($timestamp)
    {
        $this->data['Expires'] = \is_numeric($timestamp) ? (int) $timestamp : \strtotime($timestamp);
    }
    /**
     * Get whether or not this is a secure cookie
     *
     * @return bool|null
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function getSecure()
    {
        return $this->data['Secure'];
    }
    /**
<<<<<<< HEAD
     * Set whether or not the cookie is secure.
     *
     * @param bool $secure Set to true or false if secure
     */
    public function setSecure($secure) : void
    {
        if (!\is_bool($secure)) {
            trigger_deprecation('guzzlehttp/guzzle', '7.4', 'Not passing a bool to %s::%s() is deprecated and will cause an error in 8.0.', __CLASS__, __FUNCTION__);
        }
        $this->data['Secure'] = (bool) $secure;
    }
    /**
     * Get whether or not this is a session cookie.
=======
     * Set whether or not the cookie is secure
     *
     * @param bool $secure Set to true or false if secure
     */
    public function setSecure($secure)
    {
        $this->data['Secure'] = $secure;
    }
    /**
     * Get whether or not this is a session cookie
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     *
     * @return bool|null
     */
    public function getDiscard()
    {
        return $this->data['Discard'];
    }
    /**
<<<<<<< HEAD
     * Set whether or not this is a session cookie.
     *
     * @param bool $discard Set to true or false if this is a session cookie
     */
    public function setDiscard($discard) : void
    {
        if (!\is_bool($discard)) {
            trigger_deprecation('guzzlehttp/guzzle', '7.4', 'Not passing a bool to %s::%s() is deprecated and will cause an error in 8.0.', __CLASS__, __FUNCTION__);
        }
        $this->data['Discard'] = (bool) $discard;
    }
    /**
     * Get whether or not this is an HTTP only cookie.
=======
     * Set whether or not this is a session cookie
     *
     * @param bool $discard Set to true or false if this is a session cookie
     */
    public function setDiscard($discard)
    {
        $this->data['Discard'] = $discard;
    }
    /**
     * Get whether or not this is an HTTP only cookie
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     *
     * @return bool
     */
    public function getHttpOnly()
    {
        return $this->data['HttpOnly'];
    }
    /**
<<<<<<< HEAD
     * Set whether or not this is an HTTP only cookie.
     *
     * @param bool $httpOnly Set to true or false if this is HTTP only
     */
    public function setHttpOnly($httpOnly) : void
    {
        if (!\is_bool($httpOnly)) {
            trigger_deprecation('guzzlehttp/guzzle', '7.4', 'Not passing a bool to %s::%s() is deprecated and will cause an error in 8.0.', __CLASS__, __FUNCTION__);
        }
        $this->data['HttpOnly'] = (bool) $httpOnly;
=======
     * Set whether or not this is an HTTP only cookie
     *
     * @param bool $httpOnly Set to true or false if this is HTTP only
     */
    public function setHttpOnly($httpOnly)
    {
        $this->data['HttpOnly'] = $httpOnly;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    }
    /**
     * Check if the cookie matches a path value.
     *
     * A request-path path-matches a given cookie-path if at least one of
     * the following conditions holds:
     *
     * - The cookie-path and the request-path are identical.
     * - The cookie-path is a prefix of the request-path, and the last
     *   character of the cookie-path is %x2F ("/").
     * - The cookie-path is a prefix of the request-path, and the first
     *   character of the request-path that is not included in the cookie-
     *   path is a %x2F ("/") character.
     *
     * @param string $requestPath Path to check against
<<<<<<< HEAD
     */
    public function matchesPath(string $requestPath) : bool
=======
     *
     * @return bool
     */
    public function matchesPath($requestPath)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $cookiePath = $this->getPath();
        // Match on exact matches or when path is the default empty "/"
        if ($cookiePath === '/' || $cookiePath == $requestPath) {
            return \true;
        }
        // Ensure that the cookie-path is a prefix of the request path.
        if (0 !== \strpos($requestPath, $cookiePath)) {
            return \false;
        }
        // Match if the last character of the cookie-path is "/"
        if (\substr($cookiePath, -1, 1) === '/') {
            return \true;
        }
        // Match if the first character not included in cookie path is "/"
        return \substr($requestPath, \strlen($cookiePath), 1) === '/';
    }
    /**
<<<<<<< HEAD
     * Check if the cookie matches a domain value.
     *
     * @param string $domain Domain to check against
     */
    public function matchesDomain(string $domain) : bool
=======
     * Check if the cookie matches a domain value
     *
     * @param string $domain Domain to check against
     *
     * @return bool
     */
    public function matchesDomain($domain)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $cookieDomain = $this->getDomain();
        if (null === $cookieDomain) {
            return \true;
        }
        // Remove the leading '.' as per spec in RFC 6265.
<<<<<<< HEAD
        // https://tools.ietf.org/html/rfc6265#section-5.2.3
=======
        // http://tools.ietf.org/html/rfc6265#section-5.2.3
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        $cookieDomain = \ltrim(\strtolower($cookieDomain), '.');
        $domain = \strtolower($domain);
        // Domain not set or exact match.
        if ('' === $cookieDomain || $domain === $cookieDomain) {
            return \true;
        }
        // Matching the subdomain according to RFC 6265.
<<<<<<< HEAD
        // https://tools.ietf.org/html/rfc6265#section-5.1.3
=======
        // http://tools.ietf.org/html/rfc6265#section-5.1.3
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        if (\filter_var($domain, \FILTER_VALIDATE_IP)) {
            return \false;
        }
        return (bool) \preg_match('/\\.' . \preg_quote($cookieDomain, '/') . '$/', $domain);
    }
    /**
<<<<<<< HEAD
     * Check if the cookie is expired.
     */
    public function isExpired() : bool
=======
     * Check if the cookie is expired
     *
     * @return bool
     */
    public function isExpired()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->getExpires() !== null && \time() > $this->getExpires();
    }
    /**
<<<<<<< HEAD
     * Check if the cookie is valid according to RFC 6265.
=======
     * Check if the cookie is valid according to RFC 6265
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     *
     * @return bool|string Returns true if valid or an error message if invalid
     */
    public function validate()
    {
<<<<<<< HEAD
        $name = $this->getName();
        if ($name === '') {
=======
        // Names must not be empty, but can be 0
        $name = $this->getName();
        if (empty($name) && !\is_numeric($name)) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            return 'The cookie name must not be empty';
        }
        // Check if any of the invalid characters are present in the cookie name
        if (\preg_match('/[\\x00-\\x20\\x22\\x28-\\x29\\x2c\\x2f\\x3a-\\x40\\x5c\\x7b\\x7d\\x7f]/', $name)) {
            return 'Cookie name must not contain invalid characters: ASCII ' . 'Control characters (0-31;127), space, tab and the ' . 'following characters: ()<>@,;:\\"/?={}';
        }
<<<<<<< HEAD
        // Value must not be null. 0 and empty string are valid. Empty strings
        // are technically against RFC 6265, but known to happen in the wild.
        $value = $this->getValue();
        if ($value === null) {
            return 'The cookie value must not be empty';
        }
        // Domains must not be empty, but can be 0. "0" is not a valid internet
        // domain, but may be used as server name in a private network.
        $domain = $this->getDomain();
        if ($domain === null || $domain === '') {
=======
        // Value must not be empty, but can be 0
        $value = $this->getValue();
        if (empty($value) && !\is_numeric($value)) {
            return 'The cookie value must not be empty';
        }
        // Domains must not be empty, but can be 0
        // A "0" is not a valid internet domain, but may be used as server name
        // in a private network.
        $domain = $this->getDomain();
        if (empty($domain) && !\is_numeric($domain)) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            return 'The cookie domain must not be empty';
        }
        return \true;
    }
}
