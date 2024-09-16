<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\LineUser;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'token' => 'required',
        ]);

        // verify token
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.line.me/oauth2/v2.1/verify', [
            'query' => [
                'access_token' => $request->input('token')
            ]
        ]);
        $verify = json_decode($response->getBody()->getContents());

        // get profile
        $responseAuth = $client->post('https://api.line.me/v2/profile' , [
            'headers' => [
                'Authorization' => 'Bearer ' . $request->input('token')
            ]
        ]);
        $profileAuth = json_decode($responseAuth->getBody()->getContents());

        $displayName = $profileAuth->displayName;
        $pictureUrl = $profileAuth->pictureUrl;
        $userId = $profileAuth->userId;


        // check if user exists
        $user = LineUser::where('userId' , $userId)->first();
        if($user) {
            $user->displayName = $displayName;
            $user->pictureUrl = $pictureUrl;
            $user->save();
        } else {
            $user = new LineUser();
            $user->displayName = $displayName;
            $user->pictureUrl = $pictureUrl;
            $user->userId = $userId;
            $user->save();
        }

        // set session
        Session::put('profile', $profileAuth);


        // return json
        return response()->json(['message' => 'Login successful'], 200);
    }
}
