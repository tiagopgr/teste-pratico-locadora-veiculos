<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VeiculosController extends Controller
{

    public function __construct()
    {
        $marcas = Marca::pluck('nome', 'id');
        \View::share("marcas", $marcas);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \View::share("title", "Veículos");
        $data = Modelo::orderBy('created_at', 'desc')->paginate();
        return view("veiculos.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \View::share("title", "Cadastro de Veículos");
        $marcas = Marca::all()->pluck('nome', 'id');
        return view("veiculos.create", compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "marca_id" => 'required',
            "nome" => "required",
            "placa" => 'required',
            "ano" => 'required|digits:4|integer|min:1900|max:' . (date('Y'))
        ]);
        $data = $request->except(['_token']);

        if (Modelo::create($data)) {
            return redirect()->route("veiculos.index")->with('success', "Veículo registrado com sucesso.");
        } else {
            return back()->withInput()->with('err', 'Erro ao cadastrar veículo');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veiculo = Modelo::findOrFail($id);
        \View::share("title", "Dados do veículo #$veiculo->id - $veiculo->nome");
        return view("veiculos.show", compact('veiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $veiculo = Modelo::findOrFail($id);
        \View::share("title", "Editar veículo #$veiculo->id - $veiculo->nome");
        return view("veiculos.edit", compact('veiculo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "marca_id" => 'required',
            "nome" => "required",
            "placa" => 'required',
            "ano" => 'required|digits:4|integer|min:1900|max:' . (date('Y'))
        ]);
        $data = $request->except(['_token', '_method']);
        $update = Modelo::where('id', '=', $id)->update($data);

        if ($update) {
            return redirect()->route("veiculos.index")->with("success", "Dados do veículo alterado com sucesso.");
        } else {
            return back()->withErrors()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veiculo = Modelo::findOrFail($id);

        if($veiculo->destroy($id)){
            return redirect()->route("veiculos.index")->with("success", "Veículo excluido com sucesso.");
        } else {
            return back()->with('err', "Erro ao excluir veículo.");
        }
    }
}
