<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;

class BalanceController extends Controller
{
    public function index() {
      // dd(auth()->user()); // dd é o debug do Laravel
      $balance = auth()->user()->balance;
      $amount = $balance ? $balance->amount : 0;
      $decimal = $amount - floor($amount);
      $decimal = substr($decimal, (strpos($decimal, ".") + 1));
      $decimal = str_pad($decimal, 2,'0' ,STR_PAD_LEFT);

      return view('admin.balance.index', compact('amount', 'decimal'));
    }

    public function deposit(){
      return view('admin.balance.deposit');
    }

    public function depositStore(Request $request){
      $oBalance = auth()->user()->balance()->firstOrCreate([]);
      $oBalance->deposit($request->value);
      
    }
}
