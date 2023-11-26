<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
/**
 * Stream decorator that begins dropping data once the size of the underlying
 * stream becomes too full.
<<<<<<< HEAD
 */
final class DroppingStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    use StreamDecoratorTrait;
    /** @var int */
    private $maxLength;
    /** @var StreamInterface */
    private $stream;
=======
 *
 * @final
 */
class DroppingStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    use StreamDecoratorTrait;
    private $maxLength;
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    /**
     * @param StreamInterface $stream    Underlying stream to decorate.
     * @param int             $maxLength Maximum size before dropping data.
     */
<<<<<<< HEAD
    public function __construct(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, int $maxLength)
=======
    public function __construct(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, $maxLength)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $this->stream = $stream;
        $this->maxLength = $maxLength;
    }
<<<<<<< HEAD
    public function write($string) : int
=======
    public function write($string)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        $diff = $this->maxLength - $this->stream->getSize();
        // Begin returning 0 when the underlying stream is too large.
        if ($diff <= 0) {
            return 0;
        }
        // Write the stream or a subset of the stream if needed.
        if (\strlen($string) < $diff) {
            return $this->stream->write($string);
        }
        return $this->stream->write(\substr($string, 0, $diff));
    }
}
