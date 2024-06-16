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


    public function bonus()
{
    $user = auth()->user();

    if (!$user->afiliado) {
        return redirect()->route('afiliacao.index');
    }

    // Supondo que o usuário tenha um relacionamento 'afiliado' que retorna um modelo com o código de afiliado
    $codigoAfiliado = $user->afiliado->codigo_afiliado;

    // Recupera todas as recompensas baseadas no código de afiliado
    $recompensas = Referral::where('affiliate_code_id', $codigoAfiliado)->get();

    return view('afiliados.bonus', compact('recompensas'));
}


    public static function CookieSaver($ref){

        $afiliado = Afiliados::where('codigo_afiliado', $ref)->first();
        if(!$afiliado){
            return redirect('/');
        }
        $cookie = cookie()->forever('AffiliateCodeCookie', $ref);
        return redirect('/')->withCookie($cookie);

    }


    public function resgate(Request $request)
{

    $request->all();

    $recompensa = Referral::find($request->recompensaId);

    if ($recompensa->reffer_status === 'Claimed') {
        return redirect()->back()->with('error', 'Recompensa já foi resgatada');
    }

    $recompensa->reffer_status = 'Claimed';
    $recompensa->save();

    $user = auth()->user();
    $referrer = Afiliados::where('codigo_afiliado', $recompensa->affiliate_code_id)->first();

    if ($user->id !== $referrer->user_id) {
        return redirect()->back()->with('error', 'Você está tentando resgatar uma recompensa que não é sua');
    }

    switch ($recompensa->item_purchased) {
        case 'rec1': 
            $user->miningMachines()->create([
                'level' => 1,
            ]);
            break;
        case 'rec2':
            $user->miningMachines()->create([
                'level' => 2,
            ]);
            break;
        case 'rec3':
            $user->miningMachines()->create([
                'level' => 3,
            ]);
            break;
        default:
            throw new \Exception('Plano não encontrado');
    }

    return redirect()->back()->with('success', 'Recompensa resgatada com sucesso');
}

}
