<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Historic extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'total_before',
        'total_after',
        'user_id_transaction',
        'date'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function userSender(){
        return $this->belongsTo(User::class, 'user_id_transaction');
    }

    public function type($type = null){
        $types = [
            'I' => 'Entrada',
            'O' => 'Saída',
            'T' => 'Transferência'
        ];
        if(!$type)
            return $types;

        if($this->user_id_transaction != null && $type === 'I')
            return 'Recebido';
        return $types[$type];
    }

    public function typeIcon($type = null){
        $types = [
            'I' => '<i class="fa fa-download"></i>',
            'O' => '<i class="fa fa-upload"></i>',
            'T' => '<i class="fa fa-exchange"></i>'
        ];
        if(!$type)
            return $types;

        if($this->user_id_transaction != null && $type === 'I')
            return '<i class="fa fa-exchange"></i>';
            
        return $types[$type];
    }

    public function getDateAttribute($date){
        return \Carbon\Carbon::parse($date)->format('d/m/Y');
    }
}
