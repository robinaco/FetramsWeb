<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CrearPolizaRequest;
use App\Models\Poliza;
use Illuminate\Support\Facades\Log;
use Prophecy\Exception\Doubler\ReturnByReferenceException;
use Illuminate\Support\Facades\DB;


class PolizaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $polizas = Poliza::join('empresas', 'empresas.id', '=', 'polizas.idempresa')
                ->where('empresas.estado', '=', 1)
                ->get(['polizas.*', 'empresas.nombreusuario']);
            return view('poliza.index')->with('polizas', $polizas);
        } catch (\Throwable $th) {
            Log::info('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $poliza = Poliza::find($id);
            return view('poliza.edit')->with('poliza', $poliza);;
        } catch (\Throwable $th) {
            return  $th;
            Log::info('se presentó un error al editar los datos', [$th]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrearPolizaRequest $request, $id)
    {
        try {
            $mensaje = "Poliza: $request->tpoliza de: $request->aseguradora Actualizada.";
            $tipo = "success";
            $poliza = Poliza::find($id);
            $poliza->aseguradora = strtoupper($request->aseguradora);
            $poliza->version = strtoupper($request->vc);
            $poliza->tipopoliza = strtoupper($request->tpoliza);
            $poliza->numpoliza = strtoupper($request->numpol);
            $poliza->numanexo = strtoupper($request->numanx);
            $poliza->numcertificado = strtoupper($request->certificado);
            $poliza->numriesgo = strtoupper($request->numriesgo);
            $poliza->tipodocumento = strtoupper($request->tdocumento);
            $poliza->fechaexpedicion = ($request->fexp);
            $poliza->sucursarexp = strtoupper($request->suc);
            $poliza->hoursin = ($request->vini);
            $poliza->fechavigini = ($request->fini);
            $poliza->fechavigfin = ($request->ffin);
            $poliza->hoursfin = ($request->vfhr);
            $poliza->hoursfin = ($request->vfhr);
            $poliza->obs = strtoupper($request->obs);
            $poliza->save();
            return redirect('/polizas')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            return  $th;
            Log::info('se presentó un error al editar los datos', [$th]);
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
        try {
            $poliza = Poliza::find($id);
            if ($poliza) {
                $poliza->estado = 0;
                $poliza->save();
                DB::commit();
                return redirect('/polizas');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::info('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }
}
