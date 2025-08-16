<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function homecontent(){
        if (auth()->check()) {
            return view('home-feeds');
        } else {
            return view('home');
        }
    }

    public function login(Request $req){
        $fields = $req->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);
        if(auth()->attempt(['username' => $fields['loginusername'], 'password' => $fields['loginpassword']])){
            $req->session()->regenerate();
            return redirect('/')->with('success', 'You are successfully logged in.');
        }else{
            return redirect('/')->with('failure', 'Invalid email or password');
        }
    }

    public function register(Request $req){
        $fields =$req->validate([
            'username' => ['required','min:3','max:20',Rule::unique('users','username')],
            'email' => ['required','email','string','email:rfc,dns','max:255','unique:users,email',],
            'password' => 'required|string|min:8|confirmed',
        ]);
        $fields['password'] = bcrypt($fields['password']);
        $user = User::create($fields);
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for creating an account');

    }
}
