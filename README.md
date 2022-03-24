# Laravel Passport OAuth client

Purpose:
This app will be the client for the [Laravel Passport OAuth Server](https://github.com/iss1977/laravel9-passport-OAuth-server)


Development steps:
- Creating routes and Controller + methods for redirect and callback links




How it's working:

-   provide a link in the Client application, to autorize the (client) app to login to the server.
    this will execute a method in the client controller, that prepares a redirect to the server with the necessary data to get authorized on the server
    If the user is not logged in in the server, or the login has expired, the user must login on the server.

```php
/* Laravel controller method for redirect */

 $queries=http_build_query([
            'client_id'=> '6',
            'redirect_uri' => 'http://laravel-passport-client.test/oauth/callback',
            'response_type' => 'code',
        ]);

        return redirect('http://laravel-passport-server.test/oauth/authorize'.'?'.$queries);
```

    This redirect link looks like this:

    ```http://laravel-passport-server.test/oauth/authorize?client_id=6&redirect_uri=http%3A%2F%2Flaravel-passport-client.test%2Foauth%2Fcallback&response_type=code```

- after the user authorize the client app on the server ( choosing "Authorize" button), the server will redirect the browser to the client apps webpage (that was sent by the client in the previsious request) with a code that can be used to request an authorization token. This redirect will look like this:

    ```http://laravel-passport-client.test/oauth/callback?code=def502 .... 8f298c6```


