<?php

<<<<<<< HEAD
declare (strict_types=1);
=======
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
namespace YoastSEO_Vendor\GuzzleHttp\Psr7;

use YoastSEO_Vendor\Psr\Http\Message\StreamInterface;
/**
 * Compose stream implementations based on a hash of functions.
 *
 * Allows for easy testing and extension of a provided stream without needing
 * to create a concrete class for a simple extension point.
<<<<<<< HEAD
 */
#[\AllowDynamicProperties]
final class FnStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    private const SLOTS = ['__toString', 'close', 'detach', 'rewind', 'getSize', 'tell', 'eof', 'isSeekable', 'seek', 'isWritable', 'write', 'isReadable', 'read', 'getContents', 'getMetadata'];
    /** @var array<string, callable> */
    private $methods;
    /**
     * @param array<string, callable> $methods Hash of method name to a callable.
=======
 *
 * @final
 */
class FnStream implements \YoastSEO_Vendor\Psr\Http\Message\StreamInterface
{
    /** @var array */
    private $methods;
    /** @var array Methods that must be implemented in the given array */
    private static $slots = ['__toString', 'close', 'detach', 'rewind', 'getSize', 'tell', 'eof', 'isSeekable', 'seek', 'isWritable', 'write', 'isReadable', 'read', 'getContents', 'getMetadata'];
    /**
     * @param array $methods Hash of method name to a callable.
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function __construct(array $methods)
    {
        $this->methods = $methods;
        // Create the functions on the class
        foreach ($methods as $name => $fn) {
            $this->{'_fn_' . $name} = $fn;
        }
    }
    /**
     * Lazily determine which methods are not implemented.
     *
     * @throws \BadMethodCallException
     */
<<<<<<< HEAD
    public function __get(string $name) : void
=======
    public function __get($name)
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        throw new \BadMethodCallException(\str_replace('_fn_', '', $name) . '() is not implemented in the FnStream');
    }
    /**
     * The close method is called on the underlying stream only if possible.
     */
    public function __destruct()
    {
        if (isset($this->_fn_close)) {
            \call_user_func($this->_fn_close);
        }
    }
    /**
     * An unserialize would allow the __destruct to run when the unserialized value goes out of scope.
     *
     * @throws \LogicException
     */
<<<<<<< HEAD
    public function __wakeup() : void
=======
    public function __wakeup()
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    {
        throw new \LogicException('FnStream should never be unserialized');
    }
    /**
     * Adds custom functionality to an underlying stream by intercepting
     * specific method calls.
     *
<<<<<<< HEAD
     * @param StreamInterface         $stream  Stream to decorate
     * @param array<string, callable> $methods Hash of method name to a closure
=======
     * @param StreamInterface $stream  Stream to decorate
     * @param array           $methods Hash of method name to a closure
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     *
     * @return FnStream
     */
    public static function decorate(\YoastSEO_Vendor\Psr\Http\Message\StreamInterface $stream, array $methods)
    {
        // If any of the required methods were not provided, then simply
        // proxy to the decorated stream.
<<<<<<< HEAD
        foreach (\array_diff(self::SLOTS, \array_keys($methods)) as $diff) {
            /** @var callable $callable */
            $callable = [$stream, $diff];
            $methods[$diff] = $callable;
        }
        return new self($methods);
    }
    public function __toString() : string
    {
        try {
            return \call_user_func($this->_fn___toString);
        } catch (\Throwable $e) {
            if (\PHP_VERSION_ID >= 70400) {
                throw $e;
            }
            \trigger_error(\sprintf('%s::__toString exception: %s', self::class, (string) $e), \E_USER_ERROR);
            return '';
        }
    }
    public function close() : void
    {
        \call_user_func($this->_fn_close);
=======
        foreach (\array_diff(self::$slots, \array_keys($methods)) as $diff) {
            $methods[$diff] = [$stream, $diff];
        }
        return new self($methods);
    }
    public function __toString()
    {
        return \call_user_func($this->_fn___toString);
    }
    public function close()
    {
        return \call_user_func($this->_fn_close);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    }
    public function detach()
    {
        return \call_user_func($this->_fn_detach);
    }
<<<<<<< HEAD
    public function getSize() : ?int
    {
        return \call_user_func($this->_fn_getSize);
    }
    public function tell() : int
    {
        return \call_user_func($this->_fn_tell);
    }
    public function eof() : bool
    {
        return \call_user_func($this->_fn_eof);
    }
    public function isSeekable() : bool
    {
        return \call_user_func($this->_fn_isSeekable);
    }
    public function rewind() : void
    {
        \call_user_func($this->_fn_rewind);
    }
    public function seek($offset, $whence = \SEEK_SET) : void
    {
        \call_user_func($this->_fn_seek, $offset, $whence);
    }
    public function isWritable() : bool
    {
        return \call_user_func($this->_fn_isWritable);
    }
    public function write($string) : int
    {
        return \call_user_func($this->_fn_write, $string);
    }
    public function isReadable() : bool
    {
        return \call_user_func($this->_fn_isReadable);
    }
    public function read($length) : string
    {
        return \call_user_func($this->_fn_read, $length);
    }
    public function getContents() : string
    {
        return \call_user_func($this->_fn_getContents);
    }
    /**
     * @return mixed
     */
=======
    public function getSize()
    {
        return \call_user_func($this->_fn_getSize);
    }
    public function tell()
    {
        return \call_user_func($this->_fn_tell);
    }
    public function eof()
    {
        return \call_user_func($this->_fn_eof);
    }
    public function isSeekable()
    {
        return \call_user_func($this->_fn_isSeekable);
    }
    public function rewind()
    {
        \call_user_func($this->_fn_rewind);
    }
    public function seek($offset, $whence = \SEEK_SET)
    {
        \call_user_func($this->_fn_seek, $offset, $whence);
    }
    public function isWritable()
    {
        return \call_user_func($this->_fn_isWritable);
    }
    public function write($string)
    {
        return \call_user_func($this->_fn_write, $string);
    }
    public function isReadable()
    {
        return \call_user_func($this->_fn_isReadable);
    }
    public function read($length)
    {
        return \call_user_func($this->_fn_read, $length);
    }
    public function getContents()
    {
        return \call_user_func($this->_fn_getContents);
    }
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    public function getMetadata($key = null)
    {
        return \call_user_func($this->_fn_getMetadata, $key);
    }
}
