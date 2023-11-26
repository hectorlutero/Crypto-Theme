<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
/**
 * Provides a read only stream that pumps data from a PHP callable.
 *
 * When invoking the provided callable, the PumpStream will pass the amount of
 * data requested to read to the callable. The callable can choose to ignore
 * this value and return fewer or more bytes than requested. Any extra data
 * returned by the provided callable is buffered internally until drained using
 * the read() function of the PumpStream. The provided callable MUST return
 * false when there is no more data to read.
<<<<<<< HEAD
 */
final class PumpStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    /** @var callable|null */
    private $source;
    /** @var int|null */
=======
 *
 * @final
 */
class PumpStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    /** @var callable */
    private $source;
    /** @var int */
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    private $size;
    /** @var int */
    private $tellPos = 0;
    /** @var array */
    private $metadata;
    /** @var BufferStream */
    private $buffer;
    /**
<<<<<<< HEAD
     * @param callable(int): (string|false|null)  $source  Source of the stream data. The callable MAY
     *                                                     accept an integer argument used to control the
     *                                                     amount of data to return. The callable MUST
     *                                                     return a string when called, or false|null on error
     *                                                     or EOF.
     * @param array{size?: int, metadata?: array} $options Stream options:
     *                                                     - metadata: Hash of metadata to use with stream.
     *                                                     - size: Size of the stream, if known.
=======
     * @param callable $source  Source of the stream data. The callable MAY
     *                          accept an integer argument used to control the
     *                          amount of data to return. The callable MUST
     *                          return a string when called, or false on error
     *                          or EOF.
     * @param array    $options Stream options:
     *                          - metadata: Hash of metadata to use with stream.
     *                          - size: Size of the stream, if known.
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function __construct(callable $source, array $options = [])
    {
        $this->source = $source;
<<<<<<< HEAD
        $this->size = $options['size'] ?? null;
        $this->metadata = $options['metadata'] ?? [];
        $this->buffer = new \YoastSEO_Vendor\GuzzleHttp\Psr7\BufferStream();
    }
    public function __toString() : string
    {
        try {
            return \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::copyToString($this);
        } catch (\Throwable $e) {
            if (\PHP_VERSION_ID >= 70400) {
                throw $e;
            }
            \trigger_error(\sprintf('%s::__toString exception: %s', self::class, (string) $e), \E_USER_ERROR);
            return '';
        }
    }
    public function close() : void
=======
        $this->size = isset($options['size']) ? $options['size'] : null;
        $this->metadata = isset($options['metadata']) ? $options['metadata'] : [];
        $this->buffer = new \YoastSEO_Vendor\GuzzleHttp\Psr7\BufferStream();
    }
    public function __toString()
    {
        try {
            return \YoastSEO_Vendor\GuzzleHttp\Psr7\Utils::copyToString($this);
        } catch (\Exception $e) {
            return '';
        }
    }
    public function close()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->detach();
    }
    public function detach()
    {
<<<<<<< HEAD
        $this->tellPos = 0;
        $this->source = null;
        return null;
    }
    public function getSize() : ?int
    {
        return $this->size;
    }
    public function tell() : int
    {
        return $this->tellPos;
    }
    public function eof() : bool
    {
        return $this->source === null;
    }
    public function isSeekable() : bool
    {
        return \false;
    }
    public function rewind() : void
    {
        $this->seek(0);
    }
    public function seek($offset, $whence = \SEEK_SET) : void
    {
        throw new \RuntimeException('Cannot seek a PumpStream');
    }
    public function isWritable() : bool
    {
        return \false;
    }
    public function write($string) : int
    {
        throw new \RuntimeException('Cannot write to a PumpStream');
    }
    public function isReadable() : bool
    {
        return \true;
    }
    public function read($length) : string
=======
        $this->tellPos = \false;
        $this->source = null;
        return null;
    }
    public function getSize()
    {
        return $this->size;
    }
    public function tell()
    {
        return $this->tellPos;
    }
    public function eof()
    {
        return !$this->source;
    }
    public function isSeekable()
    {
        return \false;
    }
    public function rewind()
    {
        $this->seek(0);
    }
    public function seek($offset, $whence = \SEEK_SET)
    {
        throw new \RuntimeException('Cannot seek a PumpStream');
    }
    public function isWritable()
    {
        return \false;
    }
    public function write($string)
    {
        throw new \RuntimeException('Cannot write to a PumpStream');
    }
    public function isReadable()
    {
        return \true;
    }
    public function read($length)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $data = $this->buffer->read($length);
        $readLen = \strlen($data);
        $this->tellPos += $readLen;
        $remaining = $length - $readLen;
        if ($remaining) {
            $this->pump($remaining);
            $data .= $this->buffer->read($remaining);
            $this->tellPos += \strlen($data) - $readLen;
        }
        return $data;
    }
<<<<<<< HEAD
    public function getContents() : string
=======
    public function getContents()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $result = '';
        while (!$this->eof()) {
            $result .= $this->read(1000000);
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
        if (!$key) {
            return $this->metadata;
        }
<<<<<<< HEAD
        return $this->metadata[$key] ?? null;
    }
    private function pump(int $length) : void
=======
        return isset($this->metadata[$key]) ? $this->metadata[$key] : null;
    }
    private function pump($length)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($this->source) {
            do {
                $data = \call_user_func($this->source, $length);
                if ($data === \false || $data === null) {
                    $this->source = null;
                    return;
                }
                $this->buffer->write($data);
                $length -= \strlen($data);
            } while ($length > 0);
        }
    }
}
