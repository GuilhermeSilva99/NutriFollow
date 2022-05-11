<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Paciente, Nutricionista};

class NutricionistaDoPaciente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $nutricionista = Nutricionista::whereRelation('user', 'id', Auth::user()->id)->first();
        $paciente = Paciente::whereRelation('user', 'id' , $request->id)->first();
        
        if($paciente == null || $nutricionista == null)
            return back();
        
        if($paciente->nutricionista_id != $nutricionista->id)
            return redirect()->back()->withErrors(['Apenas o nutricionista do paciente pode acessar os seus dados']);

            return $next($request);
    }
}
