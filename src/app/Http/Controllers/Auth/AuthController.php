<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function register(Request $req)
    {
        $form = $req->validate([
            'email' => 'email|required|unique:users,email',
            'name' => 'string|required|',
            'password' => 'required|string|min:8'
        ]);
        try {

            $form['password'] = \bcrypt($form['password']);
            $item = User::create($form);
            $token = $item->createToken('mydevicetoken')->plainTextToken;
            return $this->sendResponse(['user' => $item, 'token' => $token], 'sucess', 201);
        } catch (Exception $e) {

            return  $this->sendError($e,$e->getMessage());
        }
    }
    public function login(Request $req)
    {
            $forms = $req->validate([
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);
        try {
            $user = User::where('email', $forms['email'])->first();
                if( $user != null ){

                    if (Hash::check($forms['password'], $user->getAuthPassword())){
                        $token = $user->createToken('mydevicetoken')->plainTextToken;
                        return $this->sendResponse(["user"=> $user, "token" => $token]);
                    }
                    else {
                        return $this->sendError('the provided password dont match!',[], 401);
                    }
                }          
                return $this->sendError('this email dont have a account yet!', [], 404);
        } catch (Exception $e) {
            return $this->sendError($e, $e->getMessage(), 500);
        }
    }
    public function logout(Request $req){
        auth()->user()->tokens()->delete();
        return $this->sendResponse('', 'logged out');
    }
}
