# Laravel Passport OAuth client

Purpose:
This app will be the client for the [Laravel Passport OAuth Server](https://github.com/iss1977/laravel9-passport-OAuth-server)


Development steps:
-   Creating routes and Controller + methods for redirect and callback links
    Inteded to work together with Oauth Server
-   Creating component for alerting.
-   Creating Model and migration to save the tokens in the database.





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


- this redirect will be captured by the ```OAuthController```s "callback" function, that will use the recieved code to aquire the token from the Oauth Server with an Http request.

```php
 $a = array(
            'grant_type' => 'authorization_code',
            'client_id' => '6',
            'client_secret' => 'R7kocHIGDVlhzEfvsYorHRke25mzUlAqMawKvNUN',
            'redirect_uri' => 'http://laravel-passport-client.test/oauth/callback',
            'code' => $request->code
        );

        $response = Http::asForm()->post('http://laravel-passport-server.test/oauth/token',$a);
```

This can be saved now to the database and associeted to our current user.

- Now we can read the list of posts from the server using the aquired token

``` php
$response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.auth()->user()->token->access_token
            ])
            ->get('http://laravel-passport-server.test'.'/api'.'/users/posts');

if($response->ok()){
    $posts = $response->json()['data'];
}
```


Thanx goes to [QiroLab](https://youtu.be/K7RfBgoeg48)
