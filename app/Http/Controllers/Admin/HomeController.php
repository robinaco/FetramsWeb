<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Poliza;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $polizas = Poliza::where('estado', '=', 1)
                ->where('fechavigfin', '<', Carbon::now()->subDays(1))
                ->get()->count();

            $polizasv = Poliza::where('estado', '=', 1)
                ->where('fechavigfin', '>', Carbon::now()->subDays(-30))
                ->get()->count();

            $registradasp = Poliza::where('estado', '=', 1)
                ->where('fechavigfin', '<', Carbon::now()->subDays(-60))
                ->get()->count();

            $contar = Empresa::where('estado', '=', 0)->count();
           $registradas =Empresa::all()->count();
            $activas = Empresa::where('estado', '!=', 0)->count();

            $vehiculos = Vehiculo::where('estado', '!=', null)->count();
            $contarp = Poliza::where('estado', '=', 1)->count();

            return view('admin.index')->with(compact('contar', 'activas','registradas', 'contarp', 'registradasp', 'polizas', 'polizasv','vehiculos'));
        } catch (\Throwable $th) {
            return  $th;
            Log::info('se presentó un error al obtener los datos', [$th]);
        }
    }
}
