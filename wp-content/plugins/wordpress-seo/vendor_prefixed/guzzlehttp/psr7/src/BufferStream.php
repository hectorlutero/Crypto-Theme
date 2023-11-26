<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
/**
 * Provides a buffer stream that can be written to to fill a buffer, and read
 * from to remove bytes from the buffer.
 *
 * This stream returns a "hwm" metadata value that tells upstream consumers
 * what the configured high water mark of the stream is, or the maximum
 * preferred size of the buffer.
<<<<<<< HEAD
 */
final class BufferStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    /** @var int */
    private $hwm;
    /** @var string */
=======
 *
 * @final
 */
class BufferStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    private $hwm;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    private $buffer = '';
    /**
     * @param int $hwm High water mark, representing the preferred maximum
     *                 buffer size. If the size of the buffer exceeds the high
     *                 water mark, then calls to write will continue to succeed
<<<<<<< HEAD
     *                 but will return 0 to inform writers to slow down
     *                 until the buffer has been drained by reading from it.
     */
    public function __construct(int $hwm = 16384)
    {
        $this->hwm = $hwm;
    }
    public function __toString() : string
    {
        return $this->getContents();
    }
    public function getContents() : string
=======
     *                 but will return false to inform writers to slow down
     *                 until the buffer has been drained by reading from it.
     */
    public function __construct($hwm = 16384)
    {
        $this->hwm = $hwm;
    }
    public function __toString()
    {
        return $this->getContents();
    }
    public function getContents()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $buffer = $this->buffer;
        $this->buffer = '';
        return $buffer;
    }
<<<<<<< HEAD
    public function close() : void
=======
    public function close()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->buffer = '';
    }
    public function detach()
    {
        $this->close();
        return null;
    }
<<<<<<< HEAD
    public function getSize() : ?int
    {
        return \strlen($this->buffer);
    }
    public function isReadable() : bool
    {
        return \true;
    }
    public function isWritable() : bool
    {
        return \true;
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
        throw new \RuntimeException('Cannot seek a BufferStream');
    }
    public function eof() : bool
    {
        return \strlen($this->buffer) === 0;
    }
    public function tell() : int
=======
    public function getSize()
    {
        return \strlen($this->buffer);
    }
    public function isReadable()
    {
        return \true;
    }
    public function isWritable()
    {
        return \true;
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
        throw new \RuntimeException('Cannot seek a BufferStream');
    }
    public function eof()
    {
        return \strlen($this->buffer) === 0;
    }
    public function tell()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        throw new \RuntimeException('Cannot determine the position of a BufferStream');
    }
    /**
     * Reads data from the buffer.
     */
<<<<<<< HEAD
    public function read($length) : string
=======
    public function read($length)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $currentLength = \strlen($this->buffer);
        if ($length >= $currentLength) {
            // No need to slice the buffer because we don't have enough data.
            $result = $this->buffer;
            $this->buffer = '';
        } else {
            // Slice up the result to provide a subset of the buffer.
            $result = \substr($this->buffer, 0, $length);
            $this->buffer = \substr($this->buffer, $length);
        }
        return $result;
    }
    /**
     * Writes data to the buffer.
     */
<<<<<<< HEAD
    public function write($string) : int
    {
        $this->buffer .= $string;
        if (\strlen($this->buffer) >= $this->hwm) {
            return 0;
        }
        return \strlen($string);
    }
    /**
     * @return mixed
     */
    public function getMetadata($key = null)
    {
        if ($key === 'hwm') {
=======
    public function write($string)
    {
        $this->buffer .= $string;
        // TODO: What should happen here?
        if (\strlen($this->buffer) >= $this->hwm) {
            return \false;
        }
        return \strlen($string);
    }
    public function getMetadata($key = null)
    {
        if ($key == 'hwm') {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            return $this->hwm;
        }
        return $key ? null : [];
    }
}
