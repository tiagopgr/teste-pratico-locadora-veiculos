<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        \View::share("title", "Resumo do sistema");
        $modelos = Modelo::all()->count();
        $users = User::all()->count();
        $alugados = Reserva::alugados()->get()->count();

        return view("dashboard.index", compact('modelos', 'users', 'alugados'));
    }
}
