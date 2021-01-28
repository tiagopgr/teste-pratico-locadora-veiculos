@extends("template.main")

@section("container")

    {!! Form::open()->route("reservas.alugar")->method("post") !!}

    <div class="row">
        <div class="col-6">
            {!! Form::select("user_id", "Usuário")->options($usuarios)!!}
        </div>
        <div class="col-6">
            {!! Form::select('modelo_id', "Modelo")->options($modelos); !!}
        </div>
        <div class="col-3">
            {!! Form::date("dt_retirada", "Data de Retirada") !!}
        </div>
        <div class="col-3">
            {!! Form::time("hr_retirada", "Hora de Retirada") !!}
        </div>
    </div>

    {!! Form::submit("Salvar")->size("lg") !!}

    {!! Form::close() !!}
@endsection()
