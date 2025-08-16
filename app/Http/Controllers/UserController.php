<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $req){
        $fields =$req->validate([
            'username' => ['required','min:3','max:20',Rule::unique('users','username')],
            'email' => ['required','email','string','email:rfc,dns','max:255','unique:users,email',],
            'password' => 'required|string|min:8|confirmed',
        ]);
        User::create($fields);
        return redirect()->back()->with('success', 'Successfully Signed Up');

    }
}
