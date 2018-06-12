@extends('site.layouts.app')

@section('title', "Meu Perfil")

@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Perfil</h1>
</div>

@include('admin.includes.alerts')

<form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="form-group">
        <label>Nome</label>
        <input type="text" value="{{auth()->user()->name}}" class="form-control" aria-describedby="emailHelp" placeholder="Nome" name="name">
    </div>
    <div class="form-group">
        <label>E-mail</label>
        <input type="email" value="{{auth()->user()->email}}" class="form-control" aria-describedby="emailHelp" placeholder="E-mail" name="email">
    </div>
    <div class="form-group">
        <label>Senha</label>
        <input type="password" class="form-control" placeholder="Senha" name="password">
    </div>
    <div class="form-group">
        @if(auth()->user()->image != null)
            <img src="{{ url('storage/users/'.auth()->user()->image) }}" alt="{{auth()->user()->nome}}" style="max-width: 64px;">
        @endif
        <label>Imagem</label>
        <input type="file" class="form-control" placeholder="" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection