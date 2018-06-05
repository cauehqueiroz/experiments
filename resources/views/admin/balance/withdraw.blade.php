@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Realizar Saque</h1>
    <ol class="breadcrumb">
      <li>
        <a href="">Dashboard</a>
      </li>
      <li>
        <a href="">Sacar</a>
      </li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Realizar Saque</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="POST" action="{{ route('withdraw.store') }}">
        {!! csrf_field() !!}
          <div class="box-body">
              
              @include('admin.includes.alerts')

              <div class="form-group">
                  <label for="exampleInputEmail1">Valor da Retirada</label>
                  <input type="text" class="form-control" id="value" name="value" placeholder="Informe o valor em R$">
              </div>
          </div><!-- /.box-body -->

          <div class="box-footer">
              <button type="submit" class="btn btn-danger">Sacar</button>
          </div>
      </form>
    </div>
@stop
