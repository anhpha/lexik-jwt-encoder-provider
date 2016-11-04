<?php

namespace Lexik;

use Lexik\OpenSSLKeyLoader;
use Namshi\JOSE\SimpleJWS;
use InvalidArgumentException;

/**
 * JWTEncoder
 *
 * @author Dev Lexik <dev@lexik.fr>
 */
class JWTEncoder implements JWTEncoderInterface
{
    const ALGORYTHM = 'RS256';

    /**
     * @var OpenSSLKeyLoader
     */
    protected $keyLoader;

    /**
     * @param OpenSSLKeyLoader $keyLoader
     */
    public function __construct(OpenSSLKeyLoader $keyLoader)
    {
        $this->keyLoader = $keyLoader;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(array $data)
    {
        $jws = new SimpleJWS(['alg' => self::ALGORYTHM]);
        $jws->setPayload($data);
        $jws->sign($this->keyLoader->loadKey('private'));

        return $jws->getTokenString();
    }

    /**
     * {@inheritdoc}
     */
    public function decode($token)
    {
        try {
            /** @var SimpleJWS $jws */
            $jws = SimpleJWS::load($token);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        if (!$jws->isValid($this->keyLoader->loadKey('public'), self::ALGORYTHM)) {
            return false;
        }

        return $jws->getPayload();
    }
}
