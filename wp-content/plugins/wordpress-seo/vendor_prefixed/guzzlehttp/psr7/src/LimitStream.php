<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
/**
 * Decorator used to return only a subset of a stream.
<<<<<<< HEAD
 */
final class LimitStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
=======
 *
 * @final
 */
class LimitStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
{
    use StreamDecoratorTrait;
    /** @var int Offset to start reading from */
    private $offset;
    /** @var int Limit the number of bytes that can be read */
    private $limit;
<<<<<<< HEAD
    /** @var StreamInterface */
    private $stream;
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    /**
     * @param StreamInterface $stream Stream to wrap
     * @param int             $limit  Total number of bytes to allow to be read
     *                                from the stream. Pass -1 for no limit.
     * @param int             $offset Position to seek to before reading (only
     *                                works on seekable streams).
     */
<<<<<<< HEAD
    public function __construct(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, int $limit = -1, int $offset = 0)
=======
    public function __construct(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, $limit = -1, $offset = 0)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->stream = $stream;
        $this->setLimit($limit);
        $this->setOffset($offset);
    }
<<<<<<< HEAD
    public function eof() : bool
=======
    public function eof()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        // Always return true if the underlying stream is EOF
        if ($this->stream->eof()) {
            return \true;
        }
        // No limit and the underlying stream is not at EOF
<<<<<<< HEAD
        if ($this->limit === -1) {
=======
        if ($this->limit == -1) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            return \false;
        }
        return $this->stream->tell() >= $this->offset + $this->limit;
    }
    /**
     * Returns the size of the limited subset of data
<<<<<<< HEAD
     */
    public function getSize() : ?int
    {
        if (null === ($length = $this->stream->getSize())) {
            return null;
        } elseif ($this->limit === -1) {
=======
     * {@inheritdoc}
     */
    public function getSize()
    {
        if (null === ($length = $this->stream->getSize())) {
            return null;
        } elseif ($this->limit == -1) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            return $length - $this->offset;
        } else {
            return \min($this->limit, $length - $this->offset);
        }
    }
    /**
     * Allow for a bounded seek on the read limited stream
<<<<<<< HEAD
     */
    public function seek($offset, $whence = \SEEK_SET) : void
=======
     * {@inheritdoc}
     */
    public function seek($offset, $whence = \SEEK_SET)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        if ($whence !== \SEEK_SET || $offset < 0) {
            throw new \RuntimeException(\sprintf('Cannot seek to offset %s with whence %s', $offset, $whence));
        }
        $offset += $this->offset;
        if ($this->limit !== -1) {
            if ($offset > $this->offset + $this->limit) {
                $offset = $this->offset + $this->limit;
            }
        }
        $this->stream->seek($offset);
    }
    /**
     * Give a relative tell()
<<<<<<< HEAD
     */
    public function tell() : int
=======
     * {@inheritdoc}
     */
    public function tell()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        return $this->stream->tell() - $this->offset;
    }
    /**
     * Set the offset to start limiting from
     *
     * @param int $offset Offset to seek to and begin byte limiting from
     *
     * @throws \RuntimeException if the stream cannot be seeked.
     */
<<<<<<< HEAD
    public function setOffset(int $offset) : void
=======
    public function setOffset($offset)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $current = $this->stream->tell();
        if ($current !== $offset) {
            // If the stream cannot seek to the offset position, then read to it
            if ($this->stream->isSeekable()) {
                $this->stream->seek($offset);
            } elseif ($current > $offset) {
                throw new \RuntimeException("Could not seek to stream offset {$offset}");
            } else {
                $this->stream->read($offset - $current);
            }
        }
        $this->offset = $offset;
    }
    /**
     * Set the limit of bytes that the decorator allows to be read from the
     * stream.
     *
     * @param int $limit Number of bytes to allow to be read from the stream.
     *                   Use -1 for no limit.
     */
<<<<<<< HEAD
    public function setLimit(int $limit) : void
    {
        $this->limit = $limit;
    }
    public function read($length) : string
    {
        if ($this->limit === -1) {
=======
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }
    public function read($length)
    {
        if ($this->limit == -1) {
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
            return $this->stream->read($length);
        }
        // Check if the current position is less than the total allowed
        // bytes + original offset
        $remaining = $this->offset + $this->limit - $this->stream->tell();
        if ($remaining > 0) {
            // Only return the amount of requested data, ensuring that the byte
            // limit is not exceeded
            return $this->stream->read(\min($remaining, $length));
        }
        return '';
    }
}