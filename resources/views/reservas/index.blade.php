@extends("template.main")

@section("container")

    <div class="row">

        <div class="col-12 mb-4">
            <a href="{{ route("reservas.alugar") }}" class="btn btn-secondary">Alugar veículo</a>
        </div>
        <div class="col-12">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @if ($errors->has('email'))
                    @endif
                </div>
            @endif

            @if($data->count() > 0)
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuário</th>
                        <th>Modelo</th>
                        <th>Placa</th>
                        <th>Retirada</th>
                        <th>Devolução</th>
                        <th>Situação</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr class="@if($row->data_entrega !== null) table-success @else table-info @endif">
                            <td scope="row">{{ $row->id }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td><a href="{{ route("veiculos.disponibilidade", $row->modelo->id) }}">{{ $row->modelo->nome }}</a></td>
                            <td>{{ $row->modelo->placa }}</td>
                            <td>{{ $row->data_retirada }}</td>
                            <td>{{ $row->data_entrega ?? "-" }}</td>
                            <td>{{ $row->situacao }}</td>
                            <td>
                                <a href="javascript:void(0)"
                                   data-reserva_id="{{ $row->id }}"
                                   class="btn btn-info btn-sm devolver-veiculo @if($row->data_entrega !== null) disabled @endif"
                                    data-toggle="modal"
                                   data-target="#modalDevolucao">Devolver</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-danger" role="alert">
                    <strong>Nenhum registro encontrado</strong>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDevolucao" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        {!! Form::open()->route("reservas.devolver")->method("post") !!}
        {!! Form::hidden("reserva_id", '') !!}
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Realiar Devolução</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            {!! Form::date("dt_devolucao", "Data de Devolucao") !!}
                        </div>
                        <div class="col-3">
                            {!! Form::time("hr_devolucao", "Hora de Devolucao") !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar Devolução</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection()
