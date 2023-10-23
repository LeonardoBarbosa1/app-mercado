<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newName()
    {
        $user = Auth::user();

        return View::make('profile/form-new-name', ['user' => $user]);
    }

    public function updateName(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|min:3',
        ];
        $feedback = [
            'name.required' => 'O campo nome é obrigatório!',
            'name.min' => 'O nome deve conter pelo menos 3 caracteres',
        ];
        $request->validate($rules, $feedback );

        $user->name = $request->input('name');

        if($user->save()){
            return redirect()->route('change-name')->with('success', 'Nome alterado com sucesso');
        }
    }

    public function newEmail()
    {
        $user = Auth::user();

        return View::make('profile/form-new-email', ['user' => $user]);
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'email' => 'required|email',
        ];
        $feedback = [
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'O email inserido não é valido',
        ];
        $request->validate($rules, $feedback );

        $user->email = $request->input('email');

        if($user->save()){
            return redirect()->route('change-email')->with('success', 'Email alterado com sucesso');
        }
    }

    public function newPassword()
    {
        return View::make('profile/form-new-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'password' => 'required|string|min:8|confirmed',
        ];

        $feedback = [
            'password.required' => 'O campo senha é obrigatório!',
            'password.min' => 'O campo senha deve conter pelo menos 8 caracteres',
            'password.confirmed' => 'A confirmação da senha não corresponde à senha fornecida',
        ];

        $request->validate($rules, $feedback );

        $user->password = bcrypt($request->input('password'));

        if($user->save()){
            return redirect()->route('change-password')->with('success', 'Senha alterada com sucesso');
        }
    }


}
