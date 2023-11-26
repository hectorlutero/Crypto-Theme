<?php

/**
 * This file is part of the league/oauth2-client library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Alex Bilbie <hello@alexbilbie.com>
 * @license http://opensource.org/licenses/MIT MIT
 * @link http://thephpleague.com/oauth2-client/ Documentation
 * @link https://packagist.org/packages/league/oauth2-client Packagist
 * @link https://github.com/thephpleague/oauth2-client GitHub
 */
namespace YoastSEO_Vendor\League\OAuth2\Client\Provider\Exception;

/**
 * Exception thrown if the provider response contains errors.
 */
class IdentityProviderException extends \Exception
{
    /**
     * @var mixed
     */
    protected $response;
    /**
     * @param string $message
     * @param int $code
<<<<<<< HEAD
     * @param mixed $response The response body
=======
     * @param array|string $response The response body
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function __construct($message, $code, $response)
    {
        $this->response = $response;
        parent::__construct($message, $code);
    }
    /**
     * Returns the exception's response body.
     *
<<<<<<< HEAD
     * @return mixed
=======
     * @return array|string
>>>>>>> c2153ee221b1a6d02020b881afc6f967c81613b8
     */
    public function getResponseBody()
    {
        return $this->response;
    }
}
