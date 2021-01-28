@extends("template.main")
@section("container")

    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route("veiculos.create") }}" class="btn btn-secondary">Cadastrar novo</a>
        </div>
        <div class="col-12">
            @if($data->count())

                {!! $data->links() !!}
                <table class="table table-striped table-bordered table-condensed">
                    <thead class="thead-inverse">
                    <tr>
                        <th>Id</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Placa</th>
                        <th>Ano</th>
                        <th>Data Cadastro</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td scope="row">{{ $row->id }}</td>
                            <td>{{ $row->marca->nome }}</td>
                            <td>{{ $row->nome }}</td>
                            <td>{{ $row->placa }}</td>
                            <td>{{ $row->ano }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>

                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button"
                                                class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            Ações
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item"
                                               href="{{ route("veiculos.show",$row->id) }}">Visualizar</a>
                                            <a class="dropdown-item"
                                               href="{{ route("veiculos.edit",$row->id) }}">Editar</a>
                                            <a class="dropdown-item delete-item"
                                               data-delete="{{route("veiculos.destroy", $row->id)}}"
                                               href="javascript:void(0)">Excluir</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {!! $data->links() !!}
            @else
                <div class="alert alert-warning" role="alert">
                    <strong>Nenhum veículo cadastrado</strong>
                </div>
            @endif
        </div>
    </div>

@endsection
