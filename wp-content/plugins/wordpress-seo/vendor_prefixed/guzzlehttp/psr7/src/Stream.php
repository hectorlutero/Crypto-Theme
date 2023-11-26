<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
/**
 * PHP stream implementation.
<<<<<<< HEAD
=======
 *
 * @var $stream
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
 */
class Stream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    /**
<<<<<<< HEAD
     * @see http://php.net/manual/function.fopen.php
     * @see http://php.net/manual/en/function.gzopen.php
     */
    private const READABLE_MODES = '/r|a\\+|ab\\+|w\\+|wb\\+|x\\+|xb\\+|c\\+|cb\\+/';
    private const WRITABLE_MODES = '/a|w|r\\+|rb\\+|rw|x|c/';
    /** @var resource */
    private $stream;
    /** @var int|null */
    private $size;
    /** @var bool */
    private $seekable;
    /** @var bool */
    private $readable;
    /** @var bool */
    private $writable;
    /** @var string|null */
    private $uri;
    /** @var mixed[] */
=======
     * Resource modes.
     *
     * @var string
     *
     * @see http://php.net/manual/function.fopen.php
     * @see http://php.net/manual/en/function.gzopen.php
     */
    const READABLE_MODES = '/r|a\\+|ab\\+|w\\+|wb\\+|x\\+|xb\\+|c\\+|cb\\+/';
    const WRITABLE_MODES = '/a|w|r\\+|rb\\+|rw|x|c/';
    private $stream;
    private $size;
    private $seekable;
    private $readable;
    private $writable;
    private $uri;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    private $customMetadata;
    /**
     * This constructor accepts an associative array of options.
     *
     * - size: (int) If a read stream would otherwise have an indeterminate
     *   size, but the size is known due to foreknowledge, then you can
     *   provide that size, in bytes.
     * - metadata: (array) Any additional metadata to return when the metadata
     *   of the stream is accessed.
     *
<<<<<<< HEAD
     * @param resource                            $stream  Stream resource to wrap.
     * @param array{size?: int, metadata?: array} $options Associative array of options.
     *
     * @throws \InvalidArgumentException if the stream is not a stream resource
     */
    public function __construct($stream, array $options = [])
=======
     * @param resource $stream  Stream resource to wrap.
     * @param array    $options Associative array of options.
     *
     * @throws \InvalidArgumentException if the stream is not a stream resource
     */
    public function __construct($stream, $options = [])
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!\is_resource($stream)) {
            throw new \InvalidArgumentException('Stream must be a resource');
        }
        if (isset($options['size'])) {
            $this->size = $options['size'];
        }
<<<<<<< HEAD
        $this->customMetadata = $options['metadata'] ?? [];
=======
        $this->customMetadata = isset($options['metadata']) ? $options['metadata'] : [];
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        $this->stream = $stream;
        $meta = \stream_get_meta_data($this->stream);
        $this->seekable = $meta['seekable'];
        $this->readable = (bool) \preg_match(self::READABLE_MODES, $meta['mode']);
        $this->writable = (bool) \preg_match(self::WRITABLE_MODES, $meta['mode']);
        $this->uri = $this->getMetadata('uri');
    }
    /**
     * Closes the stream when the destructed
     */
    public function __destruct()
    {
        $this->close();
    }
<<<<<<< HEAD
    public function __toString() : string
=======
    public function __toString()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        try {
            if ($this->isSeekable()) {
                $this->seek(0);
            }
            return $this->getContents();
<<<<<<< HEAD
        } catch (\Throwable $e) {
            if (\PHP_VERSION_ID >= 70400) {
                throw $e;
            }
            \trigger_error(\sprintf('%s::__toString exception: %s', self::class, (string) $e), \E_USER_ERROR);
            return '';
        }
    }
    public function getContents() : string
=======
        } catch (\Exception $e) {
            return '';
        }
    }
    public function getContents()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!isset($this->stream)) {
            throw new \RuntimeException('Stream is detached');
        }
<<<<<<< HEAD
        if (!$this->readable) {
            throw new \RuntimeException('Cannot read from non-readable stream');
        }
        return \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::tryGetContents($this->stream);
    }
    public function close() : void
=======
        $contents = \stream_get_contents($this->stream);
        if ($contents === \false) {
            throw new \RuntimeException('Unable to read stream contents');
        }
        return $contents;
    }
    public function close()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (isset($this->stream)) {
            if (\is_resource($this->stream)) {
                \fclose($this->stream);
            }
            $this->detach();
        }
    }
    public function detach()
    {
        if (!isset($this->stream)) {
            return null;
        }
        $result = $this->stream;
        unset($this->stream);
        $this->size = $this->uri = null;
        $this->readable = $this->writable = $this->seekable = \false;
        return $result;
    }
<<<<<<< HEAD
    public function getSize() : ?int
=======
    public function getSize()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($this->size !== null) {
            return $this->size;
        }
        if (!isset($this->stream)) {
            return null;
        }
        // Clear the stat cache if the stream has a URI
        if ($this->uri) {
            \clearstatcache(\true, $this->uri);
        }
        $stats = \fstat($this->stream);
<<<<<<< HEAD
        if (\is_array($stats) && isset($stats['size'])) {
=======
        if (isset($stats['size'])) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            $this->size = $stats['size'];
            return $this->size;
        }
        return null;
    }
<<<<<<< HEAD
    public function isReadable() : bool
    {
        return $this->readable;
    }
    public function isWritable() : bool
    {
        return $this->writable;
    }
    public function isSeekable() : bool
    {
        return $this->seekable;
    }
    public function eof() : bool
=======
    public function isReadable()
    {
        return $this->readable;
    }
    public function isWritable()
    {
        return $this->writable;
    }
    public function isSeekable()
    {
        return $this->seekable;
    }
    public function eof()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!isset($this->stream)) {
            throw new \RuntimeException('Stream is detached');
        }
        return \feof($this->stream);
    }
<<<<<<< HEAD
    public function tell() : int
=======
    public function tell()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!isset($this->stream)) {
            throw new \RuntimeException('Stream is detached');
        }
        $result = \ftell($this->stream);
        if ($result === \false) {
            throw new \RuntimeException('Unable to determine stream position');
        }
        return $result;
    }
<<<<<<< HEAD
    public function rewind() : void
    {
        $this->seek(0);
    }
    public function seek($offset, $whence = \SEEK_SET) : void
=======
    public function rewind()
    {
        $this->seek(0);
    }
    public function seek($offset, $whence = \SEEK_SET)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $whence = (int) $whence;
        if (!isset($this->stream)) {
            throw new \RuntimeException('Stream is detached');
        }
        if (!$this->seekable) {
            throw new \RuntimeException('Stream is not seekable');
        }
        if (\fseek($this->stream, $offset, $whence) === -1) {
            throw new \RuntimeException('Unable to seek to stream position ' . $offset . ' with whence ' . \var_export($whence, \true));
        }
    }
<<<<<<< HEAD
    public function read($length) : string
=======
    public function read($length)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!isset($this->stream)) {
            throw new \RuntimeException('Stream is detached');
        }
        if (!$this->readable) {
            throw new \RuntimeException('Cannot read from non-readable stream');
        }
        if ($length < 0) {
            throw new \RuntimeException('Length parameter cannot be negative');
        }
        if (0 === $length) {
            return '';
        }
<<<<<<< HEAD
        try {
            $string = \fread($this->stream, $length);
        } catch (\Exception $e) {
            throw new \RuntimeException('Unable to read from stream', 0, $e);
        }
=======
        $string = \fread($this->stream, $length);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
        if (\false === $string) {
            throw new \RuntimeException('Unable to read from stream');
        }
        return $string;
    }
<<<<<<< HEAD
    public function write($string) : int
=======
    public function write($string)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if (!isset($this->stream)) {
            throw new \RuntimeException('Stream is detached');
        }
        if (!$this->writable) {
            throw new \RuntimeException('Cannot write to a non-writable stream');
        }
        // We can't know the size after writing anything
        $this->size = null;
        $result = \fwrite($this->stream, $string);
        if ($result === \false) {
            throw new \RuntimeException('Unable to write to stream');
        }
        return $result;
    }
<<<<<<< HEAD
    /**
     * @return mixed
     */
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    public function getMetadata($key = null)
    {
        if (!isset($this->stream)) {
            return $key ? null : [];
        } elseif (!$key) {
            return $this->customMetadata + \stream_get_meta_data($this->stream);
        } elseif (isset($this->customMetadata[$key])) {
            return $this->customMetadata[$key];
        }
        $meta = \stream_get_meta_data($this->stream);
<<<<<<< HEAD
        return $meta[$key] ?? null;
=======
        return isset($meta[$key]) ? $meta[$key] : null;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    }
}
