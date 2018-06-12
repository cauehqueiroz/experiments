<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Historic;
use App\User;

use App\Http\Requests\MoneyValidationFormRequest;

class BalanceController extends Controller
{
  private $totalPage = 5;
    public function index() {
      // dd(auth()->user()); // dd é o debug do Laravel
      $balance = auth()->user()->balance;
      $amount = $balance ? $balance->amount : 0;
      $amount = number_format($amount,2,",",'.'); // pega o valor exato (sem decimais)
      list($amount,$decimal) = explode(',',$amount);
      
      return view('admin.balance.index', compact('amount', 'decimal'));
    }

    public function deposit(){
      return view('admin.balance.deposit');
    }

    public function depositStore(MoneyValidationFormRequest $request){
      $oBalance = auth()->user()->balance()->firstOrCreate([]);
      $return = $oBalance->deposit($request->value);
      if($return['success']){
        return redirect()
                ->route('admin.balance')
                ->with('success', $return['message']);
      }
      return redirect()
              ->back()
              ->with('error', $return['message']);
    }

    public function withdraw(){
      return view('admin.balance.withdraw');
    }

    public function withdrawStore(MoneyValidationFormRequest $request){
      $oBalance = auth()->user()->balance()->firstOrCreate([]);
      $return = $oBalance->withdraw($request->value);
      if($return['success']){
        return redirect()
                ->route('admin.balance')
                ->with('success', $return['message']);
      }
      return redirect()
              ->back()
              ->with('error', $return['message']);
    }

    public function transfer(){
      return view('admin.balance.transfer');
    }
    
    public function confirmTransfer(Request $request, User $oUser){
      $oSender = $oUser->getSender($request->sender);

      if(!$oSender)
        return redirect()
                ->back()
                ->with('error', "Usuário informado não foi encontrado");

      if($oSender->id === auth()->user()->id)
        return redirect()
                ->back()
                ->with('error', "Usuário informado é inválido! Não pode transferir para si!");
      
      $balance = auth()->user()->balance()->first()->amount;
      $balance = number_format($balance,2,",",'.'); // pega o valor exato (sem decimais)
      
      return view('admin.balance.transfer-confirm', compact('oSender','balance'));
    }

    public function transferStore(MoneyValidationFormRequest $request, User $oUser){
      $oSender = $oUser->find($request->sender_id);
      if(!$oSender){
        return redirect()
                ->route('admin.transfer')
                ->with('error', "Destinatário/Favorecido não encontrado");
      }
      
      $oBalance = auth()->user()->balance()->firstOrCreate([]);
      $return = $oBalance->transfer($request->value, $oSender);
      if($return['success']){
        return redirect()
                ->route('admin.balance')
                ->with('success', $return['message']);
      }
      return redirect()
              ->route('admin.transfer')
              ->with('error', $return['message']);
      dd($return);
    }

    public function historic(Historic $historic, Request $request){
      $data = $request->all();
      if($request->_token){
        $historics = $historic->search($data)->paginate($this->totalPage);
      }else{
        $historics = auth()->user()->historics()->with(['userSender'])->paginate($this->totalPage);
      }

      $types = $historic->type();
      // dd($historics);
      return view('admin.balance.historics', compact('historics', 'types', 'data'));
    }

    

}
