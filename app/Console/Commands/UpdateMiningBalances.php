<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MiningMachine;
use App\Models\User;

class UpdateMiningBalances extends Command
{
    protected $signature = 'update:maquinas';
    protected $description = 'Atualiza o status das máquinas com base em seu nível.';

    public function handle()
{
    // Atualiza os valores de todas as máquinas ativas (com energia)
    $miningMachines = MiningMachine::where('energy', '>', 0)->get();

    $miningMachines->each(function ($machine) {
        $level = $machine->level;
        $user = User::find($machine->user_id);

        // Define o ganho e o consumo de energia baseado no nível da máquina
        $gainPerLevel = $this->determineGainByLevel($level);
        $energyConsumptionPerLevel = $this->determineEnergyConsumptionByLevel($level);

        $randomValue = mt_rand(110, 190) / 100000000;

        // Calcula o valor minerado com base no nível e ganho definido
        $minedValue = ($gainPerLevel / 132) * $randomValue;  // Exemplo de conversão para um valor realista

        // Atualiza os valores da máquina
        $machine->bitcoins_mined += $minedValue;
        $machine->energy = max(0, $machine->energy - $energyConsumptionPerLevel);
        $machine->save();

        // Atualiza o saldo do usuário
        if ($user && $user->balance) {
            // Certifica-se de que o usuário tem um objeto balance associado
            $user->balance->balance += $minedValue;
            $user->balance->save();
        }
    });

    $this->info("Atualização das máquinas realizada com sucesso!");
}


    private function determineGainByLevel($level)
    {
        // Define o ganho baseado no nível; ajuste os valores conforme necessário
        switch ($level) {
            case 1:
                return 200;
            case 2:
                return 300;
            case 3:
                return 400;
            case 4:
                return 900;
        }
    }

    private function determineEnergyConsumptionByLevel($level)
    {
        // Define o consumo de energia baseado no nível; ajuste os valores conforme necessário
        switch ($level) {
            case 1:
                return 0.125;
            case 2:
                return 0.125;
            case 3:
                return 0.083;
            case 4:
                return 0.041;
        }
    }
}
