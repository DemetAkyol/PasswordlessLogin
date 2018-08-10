<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\UserLoginToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auth\MagicAuthentication;

class MagicLoginController extends Controller{

public function show()
{
    return view('auth.magic.login');

}
    public function sendToken(Request $request,MagicAuthentication $auth){
    $this->validateLogin($request);
    $auth->requestlink();





      }

public function validateLogin(Request $request)
{

    $this->validate($request, [

        'email' => 'required|email|max:255|exists:users,email'


    ]);


}
public function validateToken(Request $request, UserLoginToken $token){

    $token->delete();
    Auth::login($token->user,$request->remember);
    return redirect()->intended();      //intended: back to their intended destination after the login



}




}
