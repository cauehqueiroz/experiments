<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false; // não trabalha com o last Add/Edit

    public function deposit(float $value) : Array {
        $this->amount += number_format($value, 2, '.', '');
        $deposit = $this->save();
        if($deposit)
            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];
        return [
            'success' => false,
            'message' => 'Falha ao recarregar'
        ];
    }
}
