# lexik-jwt-encoder-provider
JWT encoder provider for Silex 2.0 based on LexikJWTAuthenticationBundle

# Usage
````php
  $ttl = 86400;
        $exp = time() + $ttl;
        $token = $this->container['lexikEncoder']()->encode(['username' => 'test', 'exp' => $exp]);
        $response = new JsonResponse();
        $response->setData(array(
            'token' => $token,
        ));
        //$response = new JsonResponse();
        return $response;
````
