<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliados;
use App\Models\User;
use App\Models\Referral;
use Illuminate\Support\Str;



class AfiliadosController extends Controller
{
    public function index(){

        $user = auth()->user();

        $user = User::with('afiliado')->findOrFail($user->id);

        return view('afiliados.instrucoes', compact('user'));
    }

    public function turnAfiliatte()
    {
        $user = auth()->user();

        // Gerar um código de 6 caracteres alfanuméricos
        $code = Str::random(6);

        // Verificar se o código já existe (opcional, para garantir unicidade)
        while (Afiliados::where('codigo_afiliado', $code)->exists()) {
            $code = Str::random(8);
        }

        $afiliado = new Afiliados;
        $afiliado->user_id = $user->id;
        $afiliado->codigo_afiliado = $code;
        $afiliado->save();

        return redirect()->back();
    }


    public function bonus(){

        $user = auth()->user();

        $recompensas = Referral::where('referred_user_id', $user->id);

        return view('afiliados.bonus', compact('recompensas'));

    }
}
