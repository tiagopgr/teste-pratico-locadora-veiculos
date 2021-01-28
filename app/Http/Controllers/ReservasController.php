<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Reserva;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index()
    {
        \View::share("title", "Reservas de Veículos");
        $data = Reserva::orderBy('id', 'desc')->with('modelo', 'user')->paginate();
        return view("reservas.index", compact('data'));
    }

    public function getAlugarVeiculo()
    {
        \View::share("title", "Realizar nova reserva");

        $usuarios = User::orderBy("name", 'ASC')->get();
        $modelosList = Modelo::orderBy('nome', 'asc')->get();
        $modelos = [];
        $modelos[""] = "Selecione";
        foreach ($modelosList as $modelo) {
            $modelos[$modelo->id] = $modelo->marca->nome . " - " . $modelo->nome;
        }

        return view("reservas.alugar", compact('modelos', 'usuarios'));
    }

    public function postAlugarVeiculo(Request $request)
    {

        $request->validate([
            "user_id" => "required",
            "modelo_id" => "required",
            "dt_retirada" => "required",
            "hr_retirada" => "required",
        ]);

        $data = $request->only('user_id', 'modelo_id');
        $data["data_retirada"] = Carbon::parse($request->post('dt_retirada') . ' ' . $request->post('hr_retirada'));

        $validacao = Reserva::alugados()->where("modelo_id", '=', $request->post('modelo_id'))->get();

        if ($validacao->count() > 0) {
            return back()->with('err', "Veículo já reservado!")->withInput();
        }


        $create = Reserva::create($data);
        if ($create) {
            return redirect()->route("reservas.index")->with("success", "Reserva feita com sucesso");
        } else {
            return back()->with('err', "Erro ao realizar reserva.")->withInput();
        }
    }


    public function devolverVeiculo(Request $request)
    {
        $id = $request->post('reserva_id');

        $request->validate([
            "dt_devolucao" => "required",
            "hr_devolucao" => "required"
        ]);


        $reserva = Reserva::findOrFail($id);
        $data = [
            "data_entrega" => Carbon::parse($request->post('dt_devolucao') . ' ' . $request->post('hr_devolucao')),
            "situacao" => 2,
        ];

        if ($reserva->update($data)) {
            return redirect()->route("reservas.index")->with("success", "Devolução realizada com sucesso.");

        } else {
            return back()->with("err", "Erro ao realizar entrega");
        }
    }
}
