@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Saldo</h1>
    <ol class="breadcrumb">
      <li>
        <a href="">Dashboard</a>
      </li>
      <li>
        <a href="">Saldo</a>
      </li>
    </ol>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12 col-xs-12">
    @include('admin.includes.alerts')
    <div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    R$ {{ $amount }},<sup style="font-size: 20px"> {{ $decimal }}</sup>
                </h3>
                <p>
                    Saldo Atual
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">
                Histórico <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <div class="btn-group-vertical btn-group-lg">
        <a href="{{ route('admin.deposit') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle"></i> Depositar</a>
        @if($amount > 0)
            <a href="{{ route('admin.withdraw') }}" class="btn btn-danger btn-lg"><i class="fa fa-minus-circle"></i> Sacar</a>
        @endif
        @if($amount > 0)
            <a href="{{ route('admin.transfer') }}" class="btn btn-default btn-lg"><i class="fa fa-exchange"></i> Transferir</a>
        @endif
        </div>
    </div><!-- ./col -->
    </div>
</div>
</div>
@stop
