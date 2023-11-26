<?php

<<<<<<< HEAD
declare (strict_types=1);
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\MessageInterface;
=======
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
/**
 * Trait implementing functionality common to requests and responses.
 */
trait MessageTrait
{
<<<<<<< HEAD
    /** @var string[][] Map of all registered headers, as original name => array of values */
    private $headers = [];
    /** @var string[] Map of lowercase header name => original name at registration */
=======
    /** @var array Map of all registered headers, as original name => array of values */
    private $headers = [];
    /** @var array Map of lowercase header name => original name at registration */
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    private $headerNames = [];
    /** @var string */
    private $protocol = '1.1';
    /** @var StreamInterface|null */
    private $stream;
<<<<<<< HEAD
    public function getProtocolVersion() : string
    {
        return $this->protocol;
    }
    public function withProtocolVersion($version) : \YoastSEO_Vendor\Psr\Http\Message\MessageInterface
=======
    public function getProtocolVersion()
    {
        return $this->protocol;
    }
    public function withProtocolVersion($version)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($this->protocol === $version) {
            return $this;
        }
        $new = clone $this;
        $new->protocol = $version;
        return $new;
    }
<<<<<<< HEAD
    public function getHeaders() : array
    {
        return $this->headers;
    }
    public function hasHeader($header) : bool
    {
        return isset($this->headerNames[\strtolower($header)]);
    }
    public function getHeader($header) : array
=======
    public function getHeaders()
    {
        return $this->headers;
    }
    public function hasHeader($header)
    {
        return isset($this->headerNames[\strtolower($header)]);
    }
    public function getHeader($header)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $header = \strtolower($header);
        if (!isset($this->headerNames[$header])) {
            return [];
        }
        $header = $this->headerNames[$header];
        return $this->headers[$header];
    }
<<<<<<< HEAD
    public function getHeaderLine($header) : string
    {
        return \implode(', ', $this->getHeader($header));
    }
    public function withHeader($header, $value) : \YoastSEO_Vendor\Psr\Http\Message\MessageInterface
=======
    public function getHeaderLine($header)
    {
        return \implode(', ', $this->getHeader($header));
    }
    public function withHeader($header, $value)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->assertHeader($header);
        $value = $this->normalizeHeaderValue($value);
        $normalized = \strtolower($header);
        $new = clone $this;
        if (isset($new->headerNames[$normalized])) {
            unset($new->headers[$new->headerNames[$normalized]]);
        }
        $new->headerNames[$normalized] = $header;
        $new->headers[$header] = $value;
        return $new;
    }
<<<<<<< HEAD
    public function withAddedHeader($header, $value) : \YoastSEO_Vendor\Psr\Http\Message\MessageInterface
=======
    public function withAddedHeader($header, $value)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->assertHeader($header);
        $value = $this->normalizeHeaderValue($value);
        $normalized = \strtolower($header);
        $new = clone $this;
        if (isset($new->headerNames[$normalized])) {
            $header = $this->headerNames[$normalized];
            $new->headers[$header] = \array_merge($this->headers[$header], $value);
        } else {
            $new->headerNames[$normalized] = $header;
            $new->headers[$header] = $value;
        }
        return $new;
    }
<<<<<<< HEAD
    public function withoutHeader($header) : \YoastSEO_Vendor\Psr\Http\Message\MessageInterface
=======
    public function withoutHeader($header)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $normalized = \strtolower($header);
        if (!isset($this->headerNames[$normalized])) {
            return $this;
        }
        $header = $this->headerNames[$normalized];
        $new = clone $this;
        unset($new->headers[$header], $new->headerNames[$normalized]);
        return $new;
    }
<<<<<<< HEAD
    public function getBody() : \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
=======
    public function getBody()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!$this->stream) {
            $this->stream = \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::streamFor('');
        }
        return $this->stream;
    }
<<<<<<< HEAD
    public function withBody(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $body) : \YoastSEO_Vendor\Psr\Http\Message\MessageInterface
=======
    public function withBody(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $body)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($body === $this->stream) {
            return $this;
        }
        $new = clone $this;
        $new->stream = $body;
        return $new;
    }
<<<<<<< HEAD
    /**
     * @param array<string|int, string|string[]> $headers
     */
    private function setHeaders(array $headers) : void
    {
        $this->headerNames = $this->headers = [];
        foreach ($headers as $header => $value) {
            // Numeric array keys are converted to int by PHP.
            $header = (string) $header;
=======
    private function setHeaders(array $headers)
    {
        $this->headerNames = $this->headers = [];
        foreach ($headers as $header => $value) {
            if (\is_int($header)) {
                // Numeric array keys are converted to int by PHP but having a header name '123' is not forbidden by the spec
                // and also allowed in withHeader(). So we need to cast it to string again for the following assertion to pass.
                $header = (string) $header;
            }
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $this->assertHeader($header);
            $value = $this->normalizeHeaderValue($value);
            $normalized = \strtolower($header);
            if (isset($this->headerNames[$normalized])) {
                $header = $this->headerNames[$normalized];
                $this->headers[$header] = \array_merge($this->headers[$header], $value);
            } else {
                $this->headerNames[$normalized] = $header;
                $this->headers[$header] = $value;
            }
        }
    }
    /**
     * @param mixed $value
     *
     * @return string[]
     */
<<<<<<< HEAD
    private function normalizeHeaderValue($value) : array
=======
    private function normalizeHeaderValue($value)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!\is_array($value)) {
            return $this->trimAndValidateHeaderValues([$value]);
        }
        if (\count($value) === 0) {
            throw new \InvalidArgumentException('Header value can not be an empty array.');
        }
        return $this->trimAndValidateHeaderValues($value);
    }
    /**
     * Trims whitespace from the header values.
     *
     * Spaces and tabs ought to be excluded by parsers when extracting the field value from a header field.
     *
     * header-field = field-name ":" OWS field-value OWS
     * OWS          = *( SP / HTAB )
     *
     * @param mixed[] $values Header values
     *
     * @return string[] Trimmed header values
     *
     * @see https://tools.ietf.org/html/rfc7230#section-3.2.4
     */
<<<<<<< HEAD
    private function trimAndValidateHeaderValues(array $values) : array
=======
    private function trimAndValidateHeaderValues(array $values)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return \array_map(function ($value) {
            if (!\is_scalar($value) && null !== $value) {
                throw new \InvalidArgumentException(\sprintf('Header value must be scalar or null but %s provided.', \is_object($value) ? \get_class($value) : \gettype($value)));
            }
            $trimmed = \trim((string) $value, " \t");
            $this->assertValue($trimmed);
            return $trimmed;
        }, \array_values($values));
    }
    /**
     * @see https://tools.ietf.org/html/rfc7230#section-3.2
     *
     * @param mixed $header
<<<<<<< HEAD
     */
    private function assertHeader($header) : void
=======
     *
     * @return void
     */
    private function assertHeader($header)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!\is_string($header)) {
            throw new \InvalidArgumentException(\sprintf('Header name must be a string but %s provided.', \is_object($header) ? \get_class($header) : \gettype($header)));
        }
<<<<<<< HEAD
=======
        if ($header === '') {
            throw new \InvalidArgumentException('Header name can not be empty.');
        }
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        if (!\preg_match('/^[a-zA-Z0-9\'`#$%&*+.^_|~!-]+$/D', $header)) {
            throw new \InvalidArgumentException(\sprintf('"%s" is not valid header name.', $header));
        }
    }
    /**
<<<<<<< HEAD
=======
     * @param string $value
     *
     * @return void
     *
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     * @see https://tools.ietf.org/html/rfc7230#section-3.2
     *
     * field-value    = *( field-content / obs-fold )
     * field-content  = field-vchar [ 1*( SP / HTAB ) field-vchar ]
     * field-vchar    = VCHAR / obs-text
     * VCHAR          = %x21-7E
     * obs-text       = %x80-FF
     * obs-fold       = CRLF 1*( SP / HTAB )
     */
<<<<<<< HEAD
    private function assertValue(string $value) : void
=======
    private function assertValue($value)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // The regular expression intentionally does not support the obs-fold production, because as
        // per RFC 7230#3.2.4:
        //
        // A sender MUST NOT generate a message that includes
        // line folding (i.e., that has any field-value that contains a match to
        // the obs-fold rule) unless the message is intended for packaging
        // within the message/http media type.
        //
        // Clients must not send a request with line folding and a server sending folded headers is
        // likely very rare. Line folding is a fairly obscure feature of HTTP/1.1 and thus not accepting
        // folding is not likely to break any legitimate use case.
        if (!\preg_match('/^[\\x20\\x09\\x21-\\x7E\\x80-\\xFF]*$/D', $value)) {
            throw new \InvalidArgumentException(\sprintf('"%s" is not valid header value.', $value));
        }
    }
}
