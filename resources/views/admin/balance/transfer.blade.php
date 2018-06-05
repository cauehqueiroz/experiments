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
          <h3 class="box-title">Realizar Transferência</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="POST" action="{{ route('transfer.confirm') }}">
        {!! csrf_field() !!}
          <div class="box-body">
              
              @include('admin.includes.alerts')

              <div class="form-group">
                  <label for="">Favorecido</label>
                  <input type="text" class="form-control" id="sender" name="sender" placeholder="Informe o nome ou e-mail">
              </div>
          </div><!-- /.box-body -->

          <div class="box-footer">
              <button type="submit" class="btn btn-default"><i class='fa fa-arrow-right'></i> Próxima etapa</button>
          </div>
      </form>
    </div>
@stop
