<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        dd($request->all());
    }
}
