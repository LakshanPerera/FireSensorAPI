<?php


namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;

class AuthLoginController extends Controller
{
    public function login(Request $request)
    {
        $http = new Client([
            'base_uri' => env('APP_URL'),
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        try {
            $promise = $http->postAsync('/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '1',
                    'client_secret' => '53NSxS4U6XZCx8lF4j4WidJ3fC6eG0D4IeeRoi2z',
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ])->then(function(ResponseInterface $msg){
                $response = json_decode($msg->getBody()->getContents());
                return $response;
            });

            $response = $promise->wait();
            return json_encode($response);

        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }
}
