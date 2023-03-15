<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;

/**
 * Summary of UserAuthController
 */
class UserAuthController extends Controller
{

    public function test(){
        $user = array();
        $user["name"] = "admin";
        $user["email"]="admin@gmail.com";
        $user["password"] = bcrypt("admin");
        User::create($user);
        return 34;
    }



    public function login(Request $request) {

        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (auth()->attempt($data)) {
            return $this->getTokenAndRefreshToken($data['email'], $data['password']);
        }
        else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function getTokenAndRefreshToken($email, $password) {
        $oClient = Client::where('password_client', 1)->first();
        $request = Request::create('http://localhost:8000/oauth/token','POST', [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ]);
        return app()->handle($request);

    }

    public function refresh(Request $request) {
        $data = $request ->validate([
            'refresh_token'=>'required'
        ]);
        $oClient = Client::where('password_client', 1)->first();
        $request = Request::create('http://localhost:8000/oauth/token','POST', [
            'grant_type' => 'refresh_token',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'refresh_token'=>$data['refresh_token'],
            'scope' => '',
        ]);
        return app()->handle($request);    }
}
// Encryption keys generated successfully.
// Personal access client created successfully.
// Client ID: 1
// Client secret: pgCeyIL9f2tIrkrRJepUraiOxIhKzWTbHXCYR74h
// Password grant client created successfully.
// Client ID: 2
// Client secret: zE2eMtn3Wn2JfjD9pRmcByxLdWdYfW2sohtU7I1I
