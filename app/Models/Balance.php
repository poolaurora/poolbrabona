<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balances';
    protected $fillable = [
        'balance',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($balance) {
            // Detecta se o saldo foi alterado
            if ($balance->isDirty('balance')) {
                $changeAmount = $balance->balance - $balance->getOriginal('balance');
                $transactionType = $changeAmount > 0 ? 'Entrada' : 'Saída';

                TransactionHistory::create([
                    'user_id' => $balance->user_id,
                    'type' => 'BTC',
                    'amount' => abs($changeAmount),
                    'description' => $transactionType,
                ]);
            }
        });
    }
    
}
