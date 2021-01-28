<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \View::share("title", "Usuários");
        $data = User::orderBy("id", 'desc')->paginate();
        return view("usuarios.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \View::share("title", "Cadastro de Usuário");

        return view("usuarios.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "email|required",
            "cpf" => "required",
            "password" => "required",
        ]);

        $data = $request->except(['_token']);
        $data["password"] = bcrypt($data["password"]);
        $data["cpf"] = preg_replace("/[^0-9]/", "", $data["cpf"]);


        if (User::create($data)) {
            return redirect()->route("usuarios.index")->with('success', "Usuário registrado com sucesso.");
        } else {
            return back()->withInput()->with('err', 'Erro ao cadastrar veículo');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        \View::share("title", "Dados do usuário #$user->id - $user->nome");

        return view("usuarios.show", compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        \View::share("title", "Editar Usuário $user->id - $user->name");
        return view('usuarios.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
           "name" => "required",
           "email" => "email|required",
           "cpf" => "required",
           "password" => "required",
        ]);

        $data = $request->except(["_token", "_method"]);
        $data["password"] = bcrypt($data["password"]);
        $data["cpf"] = preg_replace("/[^0-9]/", "", $data["cpf"]);

        $update = User::where('id', '=', $id)->update($data);

        if ($update) {
            return redirect()->route("usuarios.index")->with("success", "Dados do usuarios alterado com sucesso.");
        } else {
            return back()->withErrors()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->destroy($id)){
            return redirect()->route("usuarios.index")->with("success", "Usuário excluido com sucesso.");
        } else {
            return back()->with('err', "Erro ao excluir veículo.");
        }
    }
}
