@extends("template.main")

@section("container")


    {!! Form::open()->route("veiculos.update", [$veiculo->id])->fill($veiculo)->method('PATCH')!!}
    @include("veiculos._form")
    {!! Form::close() !!}
@endsection()
