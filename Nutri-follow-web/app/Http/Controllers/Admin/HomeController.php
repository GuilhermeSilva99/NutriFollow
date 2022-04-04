<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nutricionista;
use App\Models\User;


class HomeController extends Controller
{
    public function index($nutricionistas =null)
    {
        if(!$nutricionistas)
            $nutricionistas = Nutricionista::all();      
        return view('admin.home', ['nutricionistas' => $nutricionistas]);
    }

    public function ativar_cadastro($id)
    {
        $user = User::findOrFail($id);
        $user->cadastro_aprovado = 1;
        $user->save();
        return redirect()->route('admin.home');
    }

    public function recusar_cadastro($id)
    {
        //$user = User::findOrFail($id)->first();
        if(!$user = User::find($id))
            return redirect()->route('admin.home');

        $user->delete();
        return redirect()->route('admin.home');
    }
}
