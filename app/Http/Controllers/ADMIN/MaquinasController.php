<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MiningMachine;
use App\Models\User;


class MaquinasController extends Controller
{
    public function index(){

        return view('admin.maquinas');
    }


    public function create(Request $request) {
        // Validação dos dados submetidos no formulário
        $request->validate([
            'username' => 'required',
            'machine_qtd' => 'required|numeric',
            'machine_level' => 'required|numeric',
        ]);


        $user = User::where('username', $request->username)
        ->orWhere('email', $request->username)
        ->firstOrFail();

        for ($i = 0; $i < $request->machine_qtd; $i++) {
            $machine = new MiningMachine;
            $machine->user_id = $user->id;
            $machine->level = $request->machine_level; // Defina um nível padrão ou trate adequadamente.
            $machine->save();
        }
    
        return back()->with('success', 'Máquina criada com sucesso!');
    }

    public function charge(Request $request) {
        // Validação dos dados submetidos no formulário
        $request->validate([
            'username' => 'required',
            'machine_qtd' => 'required|numeric',
        ]);
    
        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->firstOrFail();
    
        // Obtendo as máquinas com menor energia primeiro
        $miningMachines = $user->miningMachines()
                               ->orderBy('energy', 'asc')
                               ->take($request->machine_qtd)
                               ->get();
    
        foreach ($miningMachines as $machine) {
            $machine->energy = 100; // Atualizando a energia.
            $machine->save();
        }
    
        return back()->with('success', 'Máquinas recarregadas com sucesso!');
    }    
    
    public function delete(Request $request) {
        // Validação dos dados submetidos no formulário
        $request->validate([
            'username' => 'required',
            'machine_qtd' => 'required|numeric',
        ]);
    
        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->firstOrFail();
    
        // Obtendo e deletando as máquinas mais recentes
        $machinesToDelete = $user->miningMachines()
                                 ->orderBy('created_at', 'desc')
                                 ->take($request->machine_qtd)
                                 ->get();
    
        foreach ($machinesToDelete as $machine) {
            $machine->delete();
        }
    
        return back()->with('success', 'Máquinas mais recentes deletadas com sucesso!');
    }
    
    

}
