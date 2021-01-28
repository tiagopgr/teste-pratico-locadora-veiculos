@extends("template.main")

@section("container")


    {!! Form::open()->route("usuarios.store") !!}
    @include("usuarios._form")
    {!! Form::close() !!}


@endsection()
