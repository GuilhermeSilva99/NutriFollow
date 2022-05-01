<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function redirect()
    {
        if (Auth::user()->tipo_usuario == 1) {
            return redirect()->route('admin.home');
        }

        if (Auth::user()->tipo_usuario == 2) {
            return view('home');
        }
    }
}
