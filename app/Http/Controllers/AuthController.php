<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $response = Http::post(env('API_URL') . 'api/authenticate', [
            'email_or_username' => $request->email_or_username,
            'password' => $request->password,
        ]);

        $response_body = json_decode($response->getBody(), true);

        if ($response->ok()) {

            session(['jwt_token' => $response_body['data']['token']]);
            session(['user_id' => $response_body['data']['user']['id']]);
            session(['name' => $response_body['data']['user']['name']]);
            session(['role' => $response_body['data']['role']]);
            session(['menus' => $response_body['data']['menus']]);
            session(['posko' => null]);

            if (session('role') == 'posko') {
                $response = Http::withToken(session('jwt_token'))->get(env('API_URL') . 'api/posko', ['all' => 1, 'user' => session('user_id')]);
                $response_body = json_decode($response->getBody());

                if (!is_null($response_body->data) && !empty($response_body->data)) {
                    session(['posko' =>  $response_body->data[0]->IDPosko]);
                }
            }

            return redirect('/');
        }

        return redirect()->route('login')->with('error', $response->json()['message'] ?? 'Internal server error.')->withInput();
    }

    public function logout()
    {

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }
}
