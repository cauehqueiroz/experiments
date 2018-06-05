@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Realizar Transferência</h1>
    <ol class="breadcrumb">
      <li>
        <a href="">Dashboard</a>
      </li>
      <li>
        <a href="">Transferir</a>
      </li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Confirmar Transferência</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="POST" action="{{ route('transfer.store') }}">
        {!! csrf_field() !!}
          <div class="box-body">
              
              @include('admin.includes.alerts')
              <div class="form-group">
                  <label for="">Favorecido</label>
                  <input type="text" readonly class="form-control" id="" value="{{ $oSender->name }}">
                  <input type="hidden" name="sender_id" value="{{ $oSender->id }}">
              </div>
              <div class="form-group">
                  <label for="">Saldo atual</label>
                  <input type="text" readonly class="form-control" id="" value="R$ {{ $balance }}">
              </div>

              <div class="form-group">
                  <label for="">Valor a ser transferido</label>
                  <input type="text" class="form-control" id="value" name="value" placeholder="Informe o valor em R$">
              </div>
          </div><!-- /.box-body -->

          <div class="box-footer">
              <button type="submit" class="btn btn-default"><i class='fa fa-exchange'></i> Transferir</button>
          </div>
      </form>
    </div>
@stop
