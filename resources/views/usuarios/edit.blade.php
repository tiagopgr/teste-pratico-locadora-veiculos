@extends("template.main")

@section("container")


    {!! Form::open()->route("usuarios.update", [$user->id])->fill($user)->method('PATCH')!!}
    @include("usuarios._form")
    {!! Form::close() !!}
@endsection()
