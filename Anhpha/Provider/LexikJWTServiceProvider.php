<?php

namespace Anhpha\Provider;

use Anhpha\Lexik\JWTEncoder;
use Anhpha\Lexik\OpenSSLKeyLoader;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;

/*
 * This will provide an token encoder based on lexik JWT authentication bundle
 */
class LexikJWTServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app["lexikEncoder"] = $app->protect(function () use ($app) {
            $privateKey = $app["lexik.privatekey"];
            $publicKey = $app["lexik.publickey"];
            $passPhrase = $app["lexik.pass"];
            $keyLoader = new OpenSSLKeyLoader($privateKey, $publicKey, $passPhrase);
            return new JWTEncoder($keyLoader);
        });

    }

    public function boot(Application $app)
    {

    }
}
