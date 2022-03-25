<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = [];

        if(auth()->user()->token){
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.auth()->user()->token->access_token
            ])
            ->get('http://laravel-passport-server.test'.'/api'.'/users/posts');

            if($response->ok()){
                $posts = $response->json()['data'];
            }
        }
        return view('home', ['posts'=> $posts]);
    }
}
