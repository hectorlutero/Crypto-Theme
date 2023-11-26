<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

final class Header
{
    /**
     * Parse an array of header values containing ";" separated data into an
     * array of associative arrays representing the header key value pair data
     * of the header. When a parameter does not contain a value, but just
     * contains a key, this function will inject a key with a '' string value.
     *
     * @param string|array $header Header to parse into components.
<<<<<<< HEAD
     */
    public static function parse($header) : array
    {
        static $trimmed = "\"'  \n\t\r";
        $params = $matches = [];
        foreach ((array) $header as $value) {
            foreach (self::splitList($value) as $val) {
                $part = [];
                foreach (\preg_split('/;(?=([^"]*"[^"]*")*[^"]*$)/', $val) as $kvp) {
                    if (\preg_match_all('/<[^>]+>|[^=]+/', $kvp, $matches)) {
                        $m = $matches[0];
                        if (isset($m[1])) {
                            $part[\trim($m[0], $trimmed)] = \trim($m[1], $trimmed);
                        } else {
                            $part[] = \trim($m[0], $trimmed);
                        }
                    }
                }
                if ($part) {
                    $params[] = $part;
                }
=======
     *
     * @return array Returns the parsed header values.
     */
    public static function parse($header)
    {
        static $trimmed = "\"'  \n\t\r";
        $params = $matches = [];
        foreach (self::normalize($header) as $val) {
            $part = [];
            foreach (\preg_split('/;(?=([^"]*"[^"]*")*[^"]*$)/', $val) as $kvp) {
                if (\preg_match_all('/<[^>]+>|[^=]+/', $kvp, $matches)) {
                    $m = $matches[0];
                    if (isset($m[1])) {
                        $part[\trim($m[0], $trimmed)] = \trim($m[1], $trimmed);
                    } else {
                        $part[] = \trim($m[0], $trimmed);
                    }
                }
            }
            if ($part) {
                $params[] = $part;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            }
        }
        return $params;
    }
    /**
     * Converts an array of header values that may contain comma separated
     * headers into an array of headers with no comma separated values.
     *
     * @param string|array $header Header to normalize.
     *
<<<<<<< HEAD
     * @deprecated Use self::splitList() instead.
     */
    public static function normalize($header) : array
    {
        $result = [];
        foreach ((array) $header as $value) {
            foreach (self::splitList($value) as $parsed) {
                $result[] = $parsed;
            }
        }
        return $result;
    }
    /**
     * Splits a HTTP header defined to contain a comma-separated list into
     * each individual value. Empty values will be removed.
     *
     * Example headers include 'accept', 'cache-control' and 'if-none-match'.
     *
     * This method must not be used to parse headers that are not defined as
     * a list, such as 'user-agent' or 'set-cookie'.
     *
     * @param string|string[] $values Header value as returned by MessageInterface::getHeader()
     *
     * @return string[]
     */
    public static function splitList($values) : array
    {
        if (!\is_array($values)) {
            $values = [$values];
        }
        $result = [];
        foreach ($values as $value) {
            if (!\is_string($value)) {
                throw new \TypeError('$header must either be a string or an array containing strings.');
            }
            $v = '';
            $isQuoted = \false;
            $isEscaped = \false;
            for ($i = 0, $max = \strlen($value); $i < $max; ++$i) {
                if ($isEscaped) {
                    $v .= $value[$i];
                    $isEscaped = \false;
                    continue;
                }
                if (!$isQuoted && $value[$i] === ',') {
                    $v = \trim($v);
                    if ($v !== '') {
                        $result[] = $v;
                    }
                    $v = '';
                    continue;
                }
                if ($isQuoted && $value[$i] === '\\') {
                    $isEscaped = \true;
                    $v .= $value[$i];
                    continue;
                }
                if ($value[$i] === '"') {
                    $isQuoted = !$isQuoted;
                    $v .= $value[$i];
                    continue;
                }
                $v .= $value[$i];
            }
            $v = \trim($v);
            if ($v !== '') {
                $result[] = $v;
=======
     * @return array Returns the normalized header field values.
     */
    public static function normalize($header)
    {
        if (!\is_array($header)) {
            return \array_map('trim', \explode(',', $header));
        }
        $result = [];
        foreach ($header as $value) {
            foreach ((array) $value as $v) {
                if (\strpos($v, ',') === \false) {
                    $result[] = $v;
                    continue;
                }
                foreach (\preg_split('/,(?=([^"]*"[^"]*")*[^"]*$)/', $v) as $vv) {
                    $result[] = \trim($vv);
                }
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            }
        }
        return $result;
    }
}
