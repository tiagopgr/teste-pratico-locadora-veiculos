@extends("template.main")

@section("container")


    {!! Form::open()->route("veiculos.store") !!}
    @include("veiculos._form")
    {!! Form::close() !!}


@endsection()
