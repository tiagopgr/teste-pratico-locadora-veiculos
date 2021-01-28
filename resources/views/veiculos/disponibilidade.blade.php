@extends("template.main")
@section("container")


    <div class="col-6 mx-auto">


        {!! Form::open()->method("get") !!}
        <div class="row">
            <div class="col-4">
                {!! Form::select("mes", "Mês", $meses, $mes) !!}
            </div>

            <div class="col-4">
                {!! Form::select("ano", "Ano", $anos, $ano) !!}
            </div>

            <div class="col-2">
                <div class="form-group">
                    <label for="inp-anos" style="color: transparent">selecionar</label>
                    {!! Form::submit("Alterar")->size("md") !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}

        {!! $calendar->calendar() !!}



    </div>

@endsection()
