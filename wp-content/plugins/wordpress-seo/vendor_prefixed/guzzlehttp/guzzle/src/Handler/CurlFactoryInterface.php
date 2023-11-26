<?php

namespace YoastSEO_Vendor\GuzzleHttp\Handler;

use YoastSEO_Vendor\Psr\Http\Message\RequestInterface;
interface CurlFactoryInterface
{
    /**
     * Creates a cURL handle resource.
     *
     * @param RequestInterface $request Request
     * @param array            $options Transfer options
     *
<<<<<<< HEAD
     * @throws \RuntimeException when an option cannot be applied
     */
    public function create(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options) : \YoastSEO_Vendor\GuzzleHttp\Handler\EasyHandle;
=======
     * @return EasyHandle
     * @throws \RuntimeException when an option cannot be applied
     */
    public function create(\YoastSEO_Vendor\Psr\Http\Message\RequestInterface $request, array $options);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
    /**
     * Release an easy handle, allowing it to be reused or closed.
     *
     * This function must call unset on the easy handle's "handle" property.
<<<<<<< HEAD
     */
    public function release(\YoastSEO_Vendor\GuzzleHttp\Handler\EasyHandle $easy) : void;
=======
     *
     * @param EasyHandle $easy
     */
    public function release(\YoastSEO_Vendor\GuzzleHttp\Handler\EasyHandle $easy);
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
}
