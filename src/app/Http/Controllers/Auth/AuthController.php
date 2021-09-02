<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
   public function register(Request $req) {
    
      
    try {
        $form = $req->validate([
            'email' => 'string|required|unique:users,email',
            'name' => 'string|required|',
            'password' => 'required|string|min:8'
            
        ]);
        $form['password'] = \bcrypt($form['password']);
        $item = User::create($form);
        return $this->sendResponse($item);
    }
    catch(Exception $e){
        
        return  $this->sendError($e->getMessage());
    }
   }
    
}
