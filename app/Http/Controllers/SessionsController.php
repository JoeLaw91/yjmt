<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create(Request $request){
        return view('sessions.create', ['redirect' => $request->get('redirect')]);
    }

    public function store(Request $request){
        $attributes=\request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(auth()->attempt($attributes)){
            if ($request->get('redirect'))
                return redirect($request->get('redirect'))->with('success','Welcome Back to YJMT!');
            return redirect('/')->with('success','Welcome Back to YJMT!');
        }

        throw ValidationException::withMessages([
            'email'=>'Your provided credentials could not be verified'
        ]);
    }

    public function destroy(){
        auth()->logout();
        return redirect('/')->with('success','See You..');
    }
}
