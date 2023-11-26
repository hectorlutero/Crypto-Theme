<?php

namespace YoastSEO_Vendor\GuzzleHttp\Cookie;

/**
 * Persists cookies in the client session
 */
class SessionCookieJar extends \YoastSEO_Vendor\GuzzleHttp\Cookie\CookieJar
{
<<<<<<< HEAD
    /**
     * @var string session key
     */
    private $sessionKey;
    /**
     * @var bool Control whether to persist session cookies or not.
     */
=======
    /** @var string session key */
    private $sessionKey;
    /** @var bool Control whether to persist session cookies or not. */
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    private $storeSessionCookies;
    /**
     * Create a new SessionCookieJar object
     *
<<<<<<< HEAD
     * @param string $sessionKey          Session key name to store the cookie
     *                                    data in session
     * @param bool   $storeSessionCookies Set to true to store session cookies
     *                                    in the cookie jar.
     */
    public function __construct(string $sessionKey, bool $storeSessionCookies = \false)
=======
     * @param string $sessionKey        Session key name to store the cookie
     *                                  data in session
     * @param bool $storeSessionCookies Set to true to store session cookies
     *                                  in the cookie jar.
     */
    public function __construct($sessionKey, $storeSessionCookies = \false)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        parent::__construct();
        $this->sessionKey = $sessionKey;
        $this->storeSessionCookies = $storeSessionCookies;
        $this->load();
    }
    /**
     * Saves cookies to session when shutting down
     */
    public function __destruct()
    {
        $this->save();
    }
    /**
     * Save cookies to the client session
     */
<<<<<<< HEAD
    public function save() : void
    {
        $json = [];
        /** @var SetCookie $cookie */
        foreach ($this as $cookie) {
=======
    public function save()
    {
        $json = [];
        foreach ($this as $cookie) {
            /** @var SetCookie $cookie */
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            if (\YoastSEO_Vendor\GuzzleHttp\Cookie\CookieJar::shouldPersist($cookie, $this->storeSessionCookies)) {
                $json[] = $cookie->toArray();
            }
        }
        $_SESSION[$this->sessionKey] = \json_encode($json);
    }
    /**
     * Load the contents of the client session into the data array
     */
<<<<<<< HEAD
    protected function load() : void
=======
    protected function load()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!isset($_SESSION[$this->sessionKey])) {
            return;
        }
        $data = \json_decode($_SESSION[$this->sessionKey], \true);
        if (\is_array($data)) {
            foreach ($data as $cookie) {
                $this->setCookie(new \YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie($cookie));
            }
        } elseif (\strlen($data)) {
<<<<<<< HEAD
            throw new \RuntimeException('Invalid cookie data');
=======
            throw new \RuntimeException("Invalid cookie data");
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        }
    }
}
