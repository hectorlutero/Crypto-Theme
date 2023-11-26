<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
/**
 * Stream that when read returns bytes for a streaming multipart or
 * multipart/form-data stream.
<<<<<<< HEAD
 */
final class MultipartStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    use StreamDecoratorTrait;
    /** @var string */
    private $boundary;
    /** @var StreamInterface */
    private $stream;
=======
 *
 * @final
 */
class MultipartStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    use StreamDecoratorTrait;
    private $boundary;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    /**
     * @param array  $elements Array of associative arrays, each containing a
     *                         required "name" key mapping to the form field,
     *                         name, a required "contents" key mapping to a
     *                         StreamInterface/resource/string, an optional
     *                         "headers" associative array of custom headers,
     *                         and an optional "filename" key mapping to a
     *                         string to send as the filename in the part.
     * @param string $boundary You can optionally provide a specific boundary
     *
     * @throws \InvalidArgumentException
     */
<<<<<<< HEAD
    public function __construct(array $elements = [], string $boundary = null)
    {
        $this->boundary = $boundary ?: \bin2hex(\random_bytes(20));
        $this->stream = $this->createStream($elements);
    }
    public function getBoundary() : string
    {
        return $this->boundary;
    }
    public function isWritable() : bool
=======
    public function __construct(array $elements = [], $boundary = null)
    {
        $this->boundary = $boundary ?: \sha1(\uniqid('', \true));
        $this->stream = $this->createStream($elements);
    }
    /**
     * Get the boundary
     *
     * @return string
     */
    public function getBoundary()
    {
        return $this->boundary;
    }
    public function isWritable()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return \false;
    }
    /**
     * Get the headers needed before transferring the content of a POST file
<<<<<<< HEAD
     *
     * @param array<string, string> $headers
     */
    private function getHeaders(array $headers) : string
=======
     */
    private function getHeaders(array $headers)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $str = '';
        foreach ($headers as $key => $value) {
            $str .= "{$key}: {$value}\r\n";
        }
        return "--{$this->boundary}\r\n" . \trim($str) . "\r\n\r\n";
    }
    /**
     * Create the aggregate stream that will be used to upload the POST data
     */
<<<<<<< HEAD
    protected function createStream(array $elements = []) : \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
    {
        $stream = new \YoastSEO_Vendor\GuzzleHttp\Psr7\AppendStream();
        foreach ($elements as $element) {
            if (!\is_array($element)) {
                throw new \UnexpectedValueException('An array is expected');
            }
=======
    protected function createStream(array $elements)
    {
        $stream = new \YoastSEO_Vendor\GuzzleHttp\Psr7\AppendStream();
        foreach ($elements as $element) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $this->addElement($stream, $element);
        }
        // Add the trailing boundary with CRLF
        $stream->addStream(\YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor("--{$this->boundary}--\r\n"));
        return $stream;
    }
<<<<<<< HEAD
    private function addElement(\YoastSEO_Vendor\GuzzleHttp\Psr7\AppendStream $stream, array $element) : void
=======
    private function addElement(\YoastSEO_Vendor\GuzzleHttp\Psr7\AppendStream $stream, array $element)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        foreach (['contents', 'name'] as $key) {
            if (!\array_key_exists($key, $element)) {
                throw new \InvalidArgumentException("A '{$key}' key is required");
            }
        }
        $element['contents'] = \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor($element['contents']);
        if (empty($element['filename'])) {
            $uri = $element['contents']->getMetadata('uri');
<<<<<<< HEAD
            if ($uri && \is_string($uri) && \substr($uri, 0, 6) !== 'php://' && \substr($uri, 0, 7) !== 'data://') {
                $element['filename'] = $uri;
            }
        }
        [$body, $headers] = $this->createElement($element['name'], $element['contents'], $element['filename'] ?? null, $element['headers'] ?? []);
=======
            if (\substr($uri, 0, 6) !== 'php://') {
                $element['filename'] = $uri;
            }
        }
        list($body, $headers) = $this->createElement($element['name'], $element['contents'], isset($element['filename']) ? $element['filename'] : null, isset($element['headers']) ? $element['headers'] : []);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        $stream->addStream(\YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor($this->getHeaders($headers)));
        $stream->addStream($body);
        $stream->addStream(\YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor("\r\n"));
    }
<<<<<<< HEAD
    private function createElement(string $name, \YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, ?string $filename, array $headers) : array
=======
    /**
     * @return array
     */
    private function createElement($name, \YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, $filename, array $headers)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // Set a default content-disposition header if one was no provided
        $disposition = $this->getHeader($headers, 'content-disposition');
        if (!$disposition) {
            $headers['Content-Disposition'] = $filename === '0' || $filename ? \sprintf('form-data; name="%s"; filename="%s"', $name, \basename($filename)) : "form-data; name=\"{$name}\"";
        }
        // Set a default content-length header if one was no provided
        $length = $this->getHeader($headers, 'content-length');
        if (!$length) {
            if ($length = $stream->getSize()) {
                $headers['Content-Length'] = (string) $length;
            }
        }
        // Set a default Content-Type if one was not supplied
        $type = $this->getHeader($headers, 'content-type');
        if (!$type && ($filename === '0' || $filename)) {
<<<<<<< HEAD
            $headers['Content-Type'] = \YoastSEO_Vendor\GuzzleHttp\Psr7\MimeType::fromFilename($filename) ?? 'application/octet-stream';
        }
        return [$stream, $headers];
    }
    private function getHeader(array $headers, string $key)
=======
            if ($type = \YoastSEO_Vendor\GuzzleHttp\Psr7\MimeType::fromFilename($filename)) {
                $headers['Content-Type'] = $type;
            }
        }
        return [$stream, $headers];
    }
    private function getHeader(array $headers, $key)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $lowercaseHeader = \strtolower($key);
        foreach ($headers as $k => $v) {
            if (\strtolower($k) === $lowercaseHeader) {
                return $v;
            }
        }
        return null;
    }
}
