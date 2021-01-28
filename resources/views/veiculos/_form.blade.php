{!! Form::select("marca_id", "Marca", $marcas) !!}
{!! Form::text("nome", "Nome") !!}
{!! Form::text("placa", "Placa do veículo")->max(8)!!}
{!! Form::text("ano", "Ano")->type("number") !!}
<a href="{{ route("veiculos.index") }}" class="btn btn-secundary btn-lg">Voltar</a>
{!! Form::submit("Salvar Dados")->size("lg")!!}
