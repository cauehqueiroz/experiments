@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Histórico de Transações</h1>
    <ol class="breadcrumb">
      <li>
        <a href="">Dashboard</a>
      </li>
      <li>
        <a href="">Histórico</a>
      </li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Filtrar Extrato</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
          <form role="form" method="get" action="{{ route('admin.historic') }}">
        {!! csrf_field() !!}
          <div class="box-body">
              
              @include('admin.includes.alerts')
                <div class="row">
                    <div class="col col-md-3">
                        <div class="form-group">
                            <label>Código</label>
                            <input type="text" class="form-control" id="id" name="id" placeholder="Número da operação">
                        </div>
                    </div>
                    <div class="col col-md-3">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control" name="type">
                                    <option value="">- Todos -</option>
                                @foreach($types as $type => $value)
                                    <option value="{{ $type }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-3">
                        <div class="form-group">
                            <label>Data</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="dia/mes/ano">
                        </div>
                    </div>
                    <div class="col col-md-3">
                        <div class="form-group">
                            <label>Favorecido</label>
                            <input type="text" class="form-control" id="id_user_transaction" name="id_user_transaction" placeholder="Nome ou e-mail">
                        </div>
                    </div>
                </div>
          </div><!-- /.box-body -->

          <div class="box-footer">
              <button type="submit" class="btn btn-primary">Pesquisar</button>
          </div>
      </form>
    </div>

    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Extrato completo</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
          <div class="box-body">
              <table class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Valor</th>
                          <th>Tipo</th>
                          <th>Data</th>
                          <th>Favorecido</th>
                      </tr>
                  </thead>
                  <tbody>
                       @foreach ($historics as $historic)
                            <tr>
                                <td>{{ $historic->id }}</td>
                                <td>R$ {{ number_format($historic->amount, 2, '.', '') }}</td>
                                <td>{{ $historic->type($historic->type) }}</td>
                                <td>{{ $historic->date }}</td>
                                <td>
                                    @if($historic->user_id_transaction)
                                        {{ $historic->userSender->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
              </table>

          </div><!-- /.box-body -->

          <div class="box-footer">
              {!! $historics->links() !!}
          </div>
    </div>
@stop
