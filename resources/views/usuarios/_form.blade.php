{!! Form::text("name", "Nome") !!}
{!! Form::text("email", "E-mail")->type("email")!!}
{!! Form::text("cpf", "CPF")->type("text") !!}
{!! Form::text("password", "Senha")->type("password") !!}
<a href="{{ route("veiculos.index") }}" class="btn btn-secundary btn-lg">Voltar</a>
{!! Form::submit("Salvar Dados")->size("lg")!!}
