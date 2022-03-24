<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OAuthController extends Controller
{
    public function redirect(){


        $queries=http_build_query([
            'client_id'=> '6',
            'redirect_uri' => 'http://laravel-passport-client.test/oauth/callback',
            'response_type' => 'code',
        ]);

        return redirect('http://laravel-passport-server.test/oauth/authorize'.'?'.$queries);
    }

    public function callback(Request $request){
        $a = array(
            'grant_type' => 'authorization_code',
            'client_id' => '6',
            'client_secret' => 'R7kocHIGDVlhzEfvsYorHRke25mzUlAqMawKvNUN',
            'redirect_uri' => 'http://laravel-passport-client.test/oauth/callback',
            'code' => $request->code
        );

        $response = Http::asForm()->post('http://laravel-passport-server.test/oauth/token',$a);
        return $response->json();
    }
}
