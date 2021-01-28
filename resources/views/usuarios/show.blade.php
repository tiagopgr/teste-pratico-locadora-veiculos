@extends("template.main")
@section("container")
    <div class="row">
        <div class="col-3 ">
            <label class="font-weight-bold" for="">Id:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $user->id }}</label>
        </div>
        <div class="col-3 ">
            <label class="font-weight-bold" for="">Nome:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $user->nome}}</label>
        </div>
    </div>
    <div class="row">
        <div class="col-3 ">
            <label class="font-weight-bold" for="">Email:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $user->email }}</label>
        </div>
        <div class="col-3 ">
            <label class="font-weight-bold" for="">CPF:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $user->cpf }}</label>
        </div>

        <div class="col-3 ">
            <label class="font-weight-bold" for="">Data de cadastro:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $user->created_at }}</label>
        </div>
    </div>
@endsection()
