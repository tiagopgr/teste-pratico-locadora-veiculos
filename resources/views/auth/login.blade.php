@include("template.partials._header")

<div class="container" id="form-login">

    <div class="col-6 mx-auto">

        <h2>Entrar no sistema</h2>

        @error('auth')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{ $message }}</strong>
        </div>

        <script>
            $(".alert").alert();
        </script>
        @enderror

        <form action="" method="post" autocomplete="off">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" id="email" aria-describedby="emailHelpId" value="{{ old('email') }}"
                       placeholder="E-mail">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" id="password" placeholder="Senha">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            <div class="form-group">

                <button type="submit" class="btn btn-success btn-lg">Entrar</button>
            </div>
        </form>
    </div>


</div>

@include("template.partials.footer")
