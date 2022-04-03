<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nutricionista;

class HomeController extends Controller
{
    public function index()
    {
        $nutricionistas = Nutricionista::all();

        // foreach ($nutricionistas as $nutricionista) {
            
        // }
        

        return view('admin.home', ['nutricionistas' => $nutricionistas]);
    }
}
