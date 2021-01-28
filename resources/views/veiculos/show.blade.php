@extends("template.main")
@section("container")
    <div class="row">
        <div class="col-3 ">
            <label class="font-weight-bold" for="">Id:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $veiculo->id }}</label>
        </div>
        <div class="col-3 ">
            <label class="font-weight-bold" for="">Marca:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $veiculo->marca->nome }}</label>
        </div>
    </div>
    <div class="row">
        <div class="col-3 ">
            <label class="font-weight-bold" for="">Nome:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $veiculo->nome }}</label>
        </div>
        <div class="col-3 ">
            <label class="font-weight-bold" for="">Placa:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $veiculo->placa }}</label>
        </div>

        <div class="col-3 ">
            <label class="font-weight-bold" for="">Ano:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $veiculo->ano }}</label>
        </div>
        <div class="col-3 ">
            <label class="font-weight-bold" for="">Data de cadastro:</label>
        </div>
        <div class="col-3 ">
            <label for="">{{ $veiculo->created_at }}</label>
        </div>
    </div>
@endsection()
