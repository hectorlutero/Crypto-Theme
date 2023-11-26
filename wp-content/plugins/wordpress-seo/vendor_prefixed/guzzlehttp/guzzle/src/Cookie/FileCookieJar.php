<?php

namespace YoastSEO_Vendor\GuzzleHttp\Cookie;

<<<<<<< HEAD
use YoastSEO_Vendor\GuzzleHttp\Utils;
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
/**
 * Persists non-session cookies using a JSON formatted file
 */
class FileCookieJar extends \YoastSEO_Vendor\GuzzleHttp\Cookie\CookieJar
{
<<<<<<< HEAD
    /**
     * @var string filename
     */
    private $filename;
    /**
     * @var bool Control whether to persist session cookies or not.
     */
=======
    /** @var string filename */
    private $filename;
    /** @var bool Control whether to persist session cookies or not. */
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    private $storeSessionCookies;
    /**
     * Create a new FileCookieJar object
     *
<<<<<<< HEAD
     * @param string $cookieFile          File to store the cookie data
     * @param bool   $storeSessionCookies Set to true to store session cookies
     *                                    in the cookie jar.
     *
     * @throws \RuntimeException if the file cannot be found or created
     */
    public function __construct(string $cookieFile, bool $storeSessionCookies = \false)
=======
     * @param string $cookieFile        File to store the cookie data
     * @param bool $storeSessionCookies Set to true to store session cookies
     *                                  in the cookie jar.
     *
     * @throws \RuntimeException if the file cannot be found or created
     */
    public function __construct($cookieFile, $storeSessionCookies = \false)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        parent::__construct();
        $this->filename = $cookieFile;
        $this->storeSessionCookies = $storeSessionCookies;
        if (\file_exists($cookieFile)) {
            $this->load($cookieFile);
        }
    }
    /**
     * Saves the file when shutting down
     */
    public function __destruct()
    {
        $this->save($this->filename);
    }
    /**
     * Saves the cookies to a file.
     *
     * @param string $filename File to save
<<<<<<< HEAD
     *
     * @throws \RuntimeException if the file cannot be found or created
     */
    public function save(string $filename) : void
    {
        $json = [];
        /** @var SetCookie $cookie */
        foreach ($this as $cookie) {
=======
     * @throws \RuntimeException if the file cannot be found or created
     */
    public function save($filename)
    {
        $json = [];
        foreach ($this as $cookie) {
            /** @var SetCookie $cookie */
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            if (\YoastSEO_Vendor\GuzzleHttp\Cookie\CookieJar::shouldPersist($cookie, $this->storeSessionCookies)) {
                $json[] = $cookie->toArray();
            }
        }
<<<<<<< HEAD
        $jsonStr = \YoastSEO_Vendor\GuzzleHttp\Utils::jsonEncode($json);
=======
        $jsonStr = \YoastSEO_Vendor\GuzzleHttp\json_encode($json);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        if (\false === \file_put_contents($filename, $jsonStr, \LOCK_EX)) {
            throw new \RuntimeException("Unable to save file {$filename}");
        }
    }
    /**
     * Load cookies from a JSON formatted file.
     *
     * Old cookies are kept unless overwritten by newly loaded ones.
     *
     * @param string $filename Cookie file to load.
<<<<<<< HEAD
     *
     * @throws \RuntimeException if the file cannot be loaded.
     */
    public function load(string $filename) : void
=======
     * @throws \RuntimeException if the file cannot be loaded.
     */
    public function load($filename)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $json = \file_get_contents($filename);
        if (\false === $json) {
            throw new \RuntimeException("Unable to load file {$filename}");
<<<<<<< HEAD
        }
        if ($json === '') {
            return;
        }
        $data = \YoastSEO_Vendor\GuzzleHttp\Utils::jsonDecode($json, \true);
        if (\is_array($data)) {
            foreach ($data as $cookie) {
                $this->setCookie(new \YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie($cookie));
            }
        } elseif (\is_scalar($data) && !empty($data)) {
=======
        } elseif ($json === '') {
            return;
        }
        $data = \YoastSEO_Vendor\GuzzleHttp\json_decode($json, \true);
        if (\is_array($data)) {
            foreach (\json_decode($json, \true) as $cookie) {
                $this->setCookie(new \YoastSEO_Vendor\GuzzleHttp\Cookie\SetCookie($cookie));
            }
        } elseif (\strlen($data)) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            throw new \RuntimeException("Invalid cookie file: {$filename}");
        }
    }
}
