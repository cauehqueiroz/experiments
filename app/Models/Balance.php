<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class Balance extends Model
{
    public $timestamps = false; // não trabalha com o last Add/Edit

    public function deposit(float $value) : Array {
        try {
            DB::beginTransaction();
            $totalBefore = $this->amount ? $this->amount : 0;
            $this->amount += number_format($value, 2, '.', '');
            $deposit = $this->save();

            $historic = auth()->user()->historics()->create([
                'type' => 'I',
                'amount' => $value,
                'total_before' => $totalBefore,
                'total_after' => $this->amount,
                'user_id_transaction' => NULL,
                'date' => date("Ymd")
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            return [
                'success' => false,
                'message' => 'Falha ao recarregar. ' . $e->getMessage()
            ];
        }
        
        return [
            'success' => true,
            'message' => 'Depósito bem sucedido!'
        ];
    }
    
    public function withdraw(float $value) : Array {
        if($this->amount < $value)
            return [
                'success' => false,
                'message' => 'Saldo insuficiente para realizar saque!'
            ];
        try {
            DB::beginTransaction();
            $totalBefore = $this->amount;
            $this->amount -= number_format($value, 2, '.', '');
            $withdraw = $this->save();

            $historic = auth()->user()->historics()->create([
                'type' => 'O',
                'amount' => $value,
                'total_before' => $totalBefore,
                'total_after' => $this->amount,
                'user_id_transaction' => NULL,
                'date' => date("Ymd")
            ]);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            return [
                'success' => false,
                'message' => 'Falha ao Sacar. ' . $e->getMessage()
            ];
        }

        return [
            'success' => true,
            'message' => 'Saque realizado com sucesso'
        ];
    }

    public function transfer(float $value, User $oSender) : Array {

        if($this->amount < $value)
            return [
                'success' => false,
                'message' => 'Saldo insuficiente para realizar a trasnferência!'
            ];

        try {
            DB::beginTransaction();

            /* ATUALIZA O PRÓPRIO SALDO */
            $totalBefore = $this->amount;
            $this->amount -= number_format($value, 2, '.', '');
            $withdraw = $this->save();

            $historic = auth()->user()->historics()->create([
                'type' => 'T',
                'amount' => $value,
                'total_before' => $totalBefore,
                'total_after' => $this->amount,
                'user_id_transaction' => $oSender->id,
                'date' => date("Ymd")
            ]);

            /* ATUALIZA O SALDO DO FAVORECIDO */
            $oBalanceSender = $oSender->balance()->firstOrCreate([]);
            $totalBeforeSender = $oBalanceSender->amount ? $oBalanceSender->amount : 0;
            $oBalanceSender->amount += number_format($value, 2, '.', '');
            $oBalanceSender->save();

            $oSender->historics()->create([
                'type' => 'T',
                'amount' => $value,
                'total_before' => $totalBeforeSender,
                'total_after' => $oBalanceSender->amount,
                'user_id_transaction' => auth()->user()->id,
                'date' => date("Ymd")
            ]);

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            return [
                'success' => false,
                'message' => 'Falha ao transferir. ' . $e->getMessage()
            ];
        }

        return [
            'success' => true,
            'message' => 'Transferência realizada com sucesso!'
        ];
    }
}
