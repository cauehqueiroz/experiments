@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Fazer Recarga</h1>
    <ol class="breadcrumb">
      <li>
        <a href="">Dashboard</a>
      </li>
      <li>
        <a href="">Recarregar</a>
      </li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Informações de Recarga</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="POST" action="{{ route('deposit.store') }}">
        {!! csrf_field() !!}
          <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">Valor da Recarga</label>
                  <input type="text" class="form-control" id="value" name="value" placeholder="Informe o valor em R$">
              </div>
          </div><!-- /.box-body -->

          <div class="box-footer">
              <button type="submit" class="btn btn-primary">Recarregar</button>
          </div>
      </form>
    </div>
@stop
