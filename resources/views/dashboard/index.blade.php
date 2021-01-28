@extends("template.main")

@section("container")

    <div class="row">

        <div class="col-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h4 class="card-title">Veículos</h4>
                    <p class="card-text">{{ $modelos }}</p>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h4 class="card-title">Usuários</h4>
                    <p class="card-text">{{ $users }}</p>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h4 class="card-title">Alugados</h4>
                    <p class="card-text">{{ $alugados }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
