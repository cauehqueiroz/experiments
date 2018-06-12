<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileFormRequest;

class UserController extends Controller
{
    public function profile(){
        return view('site.profile.profile');
    }

    public function profileUpdate(UpdateProfileFormRequest $request){
        $user = auth()->user();
        $data = $request->all();
        if(isset($data['password']) && $data['password'] != null){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        $data['image'] = $user->image;
        if($request->hasFile('image') && $request->file('image')->isValid()){
            if($user->image)
                $name = $user->image;
            else
                $name = $user->id;
            $ext = $request->image->extension();
            $filename = "$name.$ext";
            $data['image'] = $filename;
            $upload = $request->image->storeAs('users', $filename);
            if(!$upload)
                return redirect()
                    ->route('profile')
                    ->with('error','Falha ao persistir a imagem!');
        }
        
        $updated = $user->update($data);

        if($updated)
            return redirect()
            ->route('profile')
            ->with('success','Atualizado com sucesso!');
        return redirect()
            ->route('profile')
            ->with('error','Falha ao atualizar!');
    }
}
