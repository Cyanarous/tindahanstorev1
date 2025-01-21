<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{   
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        // checks if the user is existing
        if(auth('web')->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(){
        auth('web')->logout();
        return redirect('/');
    }

    public function register(Request $request){
        // validation
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:12', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:20'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']); //bcrypt is for hashing passwords
        $user = User::create($incomingFields);
        auth('web')->login($user);

        return redirect('/');
    }
}
