<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Empresa;
use App\Models\Archivo;
use App\Models\Marca;
use App\Exports\EmpresasExport;
use App\Exports\VehiculosExport;
use App\Exports\PolizasExport;
use DateTime;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use JeroenNoten\LaravelAdminLte\Components\Widget\Alert;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CreateEmpresaPostRequest;
use App\Http\Requests\CrearPolizaRequest;
use App\Http\Requests\vehiculoPostRequest;
use PDF;


use App\Models\Poliza;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Response;


class EmpresaController extends Controller
{


    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
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
            $empresas = Empresa::where('estado', '=', 1)->paginate(0);
            return view('empresa.index')->with('empresas', $empresas);
        } catch (\Throwable $th) {
            Log::info('se presentó un error al obtener la lista', $th);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $municipios = Municipio::pluck('nombre');
            return view('empresa.create', compact('municipios'));
        } catch (\Throwable $th) {
            Log::info('se presentó un error al obtener los datos', $th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmpresaPostRequest $request)
    {
        try {
            $mensaje = "Empresa: $request->name Registrada Satisfactoriamente.";
            $tipo = "success";
            $empresas = new Empresa();
            $empresas->nombreusuario = strtoupper($request->name);
            $empresas->tipodocto = $request->tdocto;
            $empresas->documento = $request->docto;
            $empresas->direccion = strtoupper($request->dir);
            $empresas->email = $request->email;
            $empresas->presidente = strtoupper($request->replegal);
            $empresas->municipio = $request->municipio;
            $empresas->telefono = $request->tel;
            $empresas->habilitacion = $request->hb;
            $empresas->permiso = $request->permiso;
            $empresas->numpermiso = $request->numper;
            $empresas->numhabilitacion = $request->numh;
            $empresas->save();
            return redirect('/empresas')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            Log::info('se presentó un error al grabar los datos', [$th]);
            return  $th;
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
        try {
            $empresa = Empresa::find($id);
            $archivos = Archivo::join('empresas', 'empresas.id', '=', 'archivos.idempresa')
                ->select('archivos.namefile', 'archivos.id')
                ->where('empresas.id', '=', $id)
                ->get();
                  
            $polizas = Poliza::join('empresas', 'empresas.id', '=', 'polizas.idempresa')
                ->where('empresas.estado', '=', 1)
                ->where('polizas.idempresa', '=', $id)
                ->get(['polizas.*', 'empresas.nombreusuario']);
               
            $vehiculos = Vehiculo::join('empresas', 'empresas.id', '=', 'vehiculos.idempresa')
                ->where('empresas.estado', '=', 1)
                ->where('vehiculos.idempresa', '=', $id)
                ->get(['vehiculos.*']);
               

            return view('empresa.detalle', compact('empresa', 'archivos', 'polizas', 'vehiculos'));
        } catch (\Throwable $th) {
            Log::info('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
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
            $empresa = Empresa::find($id);
            $municipios = Municipio::pluck('nombre');
            return view('empresa.edit', compact('municipios', 'empresa'));
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
    public function update(CreateEmpresaPostRequest  $request, $id)
    {
        try {
            $mensaje = "Empresa: $request->name ha sido Actualizada";
            $tipo = "success";
            $empresa = Empresa::find($id);
            $empresa->nombreusuario = strtoupper($request->name);
            $empresa->tipodocto = $request->tdocto;
            $empresa->documento = $request->docto;
            $empresa->direccion = strtoupper($request->dir);
            $empresa->email = $request->email;
            $empresa->presidente = strtoupper($request->replegal);
            $empresa->municipio = $request->municipio;
            $empresa->telefono = $request->tel;
            $empresa->habilitacion = $request->hb;
            $empresa->permiso = $request->permiso;
            $empresa->numhabilitacion = $request->numh;
            $empresa->numpermiso = $request->numper;
            $empresa->save();
            return redirect('/empresas')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            Log::info('se presentó un error al grabar los datos', [$th]);
            return  $th;
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
            $empresa = Empresa::find($id);
            if ($empresa) {
                $empresa->estado = 0;
                $empresa->save();
                DB::commit();
                return redirect('/empresas');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::info('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }

        // return ($id);
    }

    public function CrearVehiculo($id)
    {
        try {
            $empresa = Empresa::find($id);
            $marcas = Marca::all();
            $polizas = Poliza::join('empresas', 'empresas.id', '=', 'polizas.idempresa')
                ->where('empresas.estado', '=', 1)
                ->where('polizas.idempresa', '=', $id)
                ->get(['polizas.*']);
                $wordCount = count($polizas);
                if($wordCount>0){
                    return view('empresa.createv', compact('empresa', 'marcas', 'polizas'));
                }else{
                    $mensajes = "No es posible agregar vehiculos a $empresa->nombreusuario, debe crearle primero las polizas.";
                    $tipos = "danger";
                    return redirect('/empresas')->with("mensajes", $mensajes)->with("tipos", $tipos);
                };
            
        } catch (\Throwable $th) {
            Log::error('se presentó un error al consultar los datos', [$th]);
            return  $th;
        }
    }



    /**
     * return view add documents to buissnes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fileUpload($id)
    {
        try {
            $empresa = Empresa::find($id);
            return view('empresa.adjuntar')->with('empresa', $empresa);
        } catch (\Throwable $th) {
            return  $th;
            Log::info('se presentó un error al editar los datos', [$th]);
        }
    }




    /**
     * Metodo para almacenar los archivos adjuntos por empresa.
     *
     * @return \Illuminate\Http\Response
     */

    public function saveUpload(Request $request, $id)
    {
        try {
            $mensaje = "Archivos Cargados Correctamente.";
            $tipo = "success";
            $urlImagenes = [];
            if ($request->hasFile('files')) {
                $images = $request->file('files');
                foreach ($images as $imagen) {
                    $nombrefile = time() . '_' . $id . '_' . $imagen->getClientOriginalName();
                    $path = Storage::putFileAs('public/Archivos/' . 'Documentos', $imagen, $nombrefile);
                    $urlImagenes[] = $nombrefile;
                }
                $c = count($urlImagenes);
                for ($i = 0; $i < $c; $i++) {
                    Archivo::create([
                        'namefile' => $urlImagenes[$i],
                        'idempresa' => $id
                    ]);
                }
                DB::commit();
                return back()
                    ->with("mensaje", $mensaje)
                    ->with("tipo", $tipo);
            } else {

                $mensaje = "Error realizando el proceso. Intente más tarde";
                $tipo = "danger";
            }
        } catch (\Throwable $th) {

            Log::info('se presentó un error al grabar los datos', [$th]);
            DB::rollback();
            return  $th;
        }
    }


    public function exportempresas()
    {
        try {
            return Excel::download(new EmpresasExport, 'Reporte_Empresas.xlsx');
        } catch (\Throwable $th) {
            Log::info('se presentó un error al exportar los datos', [$th]);
            return  $th;
        }
    }

    public function exportvehiculos()
    {
        try {
            return Excel::download(new VehiculosExport, 'Reporte_Vehiculos.xlsx');
        } catch (\Throwable $th) {
            Log::info('se presentó un error al exportar los datos', [$th]);
            return  $th;
        }
    }
    
    public function exportpolizas()
    {
        try {
            return Excel::download(new PolizasExport, 'Reporte_Polizas.xlsx');
        } catch (\Throwable $th) {
            Log::info('se presentó un error al exportar los datos', [$th]);
            return  $th;
        }
    }


    public function EditarVehiculo($id)
    {
        try {
            $vehiculo = Vehiculo::find($id);
            $polizas = $vehiculo->idempresa;
            $policy = Poliza::all()->where('idempresa', '=', $polizas);
            $marcas = Marca::all();
            return view('empresa.detallevh', compact('vehiculo', 'marcas', 'policy'));
        } catch (\Throwable $th) {
            Log::info('se presentó un error al obtener los datos', [$th]);
            return  $th;
        }
    }



    public function UpdateVehiculo(vehiculoPostRequest $request, $id)
    {
        try {
            $mensaje = "Vehiculo: $request->placa  Actualizado.";
            $tipo = "success";
            $vehiculo=Vehiculo::find($id);
            $vehiculo->marca = ($request->marca);
            $vehiculo->idempresa = ($request->idempresa);
            $vehiculo->modelo = ($request->modelo);
            $vehiculo->placa = strtoupper($request->placa);
            $vehiculo->kilometros = ($request->km);
            $vehiculo->chasis = ($request->chasis);
            $vehiculo->motor = ($request->motor);
            $vehiculo->numatricula = ($request->matricula);
            $vehiculo->tservicio = ($request->tservicio);
            $vehiculo->tecnomec = ($request->tecno);
            $vehiculo->numsoat = ($request->soat);
            $vehiculo->lconduccion = ($request->lcn);
            $vehiculo->propietario = strtoupper($request->namep);
            $vehiculo->docpropietario = ($request->di);
            $vehiculo->celular = ($request->celtel);
            $vehiculo->observaciones  = strtoupper($request->obs);
            $json = $request->policy;
            $vehiculo->polizas  = json_encode($json);
            $vehiculo->save();
            return redirect('/empresas')->with("mensaje", $mensaje)->with("tipo", $tipo);
            
        } catch (\Throwable $th) {
            Log::info('se presentó un error al grabar los datos', [$th]);
            return  $th;
        }
    }






    public function deleteFile($fileid)
    {
        try {
            $file = Archivo::find($fileid);
            if ($file) {
                $image_path = Storage::delete('public/Archivos/' . 'Documentos/' . $file->namefile);
                $file->delete();
                return back();
            }
        } catch (\Throwable $th) {
            Log::info('se presentó un error al exportar los datos', [$th]);
            return  $th;
        }
    }



    public function CrearPoliza($id)
    {
        try {
            $empresa = Empresa::find($id);
            return view('empresa.poliza')->with('empresa', $empresa);
        } catch (\Throwable $th) {
            Log::info('se presentó un error al exportar los datos', [$th]);
            return  $th;
        }
    }



    public function SavePoliza(CrearPolizaRequest $request)
    {
        try {
            $mensaje = "Poliza: $request->tpoliza de: $request->aseguradora creada satisfactoriamente.";
            $tipo = "success";
            $poliza = new Poliza();
            $poliza->idempresa = strtoupper($request->idempresa);
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
            Log::error('se presentó un error al exportar los datos', [$th]);
            return  $th;
        }
    }





    public function SaveVehiculo(vehiculoPostRequest $request)
    {
        try {
            $mensaje = "Vehiculo: $request->placa  creado satisfactoriamente.";
            $tipo = "success";
            $vehiculo = new Vehiculo();
            $vehiculo->marca = ($request->marca);
            $vehiculo->idempresa = ($request->idempresa);
            $vehiculo->modelo = ($request->modelo);
            $vehiculo->placa = strtoupper($request->placa);
            $vehiculo->kilometros = ($request->km);
            $vehiculo->chasis = ($request->chasis);
            $vehiculo->motor = ($request->motor);
            $vehiculo->numatricula = ($request->matricula);
            $vehiculo->tservicio = ($request->tservicio);
            $vehiculo->tecnomec = ($request->tecno);
            $vehiculo->numsoat = ($request->soat);
            $vehiculo->lconduccion = ($request->lcn);
            $vehiculo->propietario = strtoupper($request->namep);
            $vehiculo->docpropietario = ($request->di);
            $vehiculo->celular = ($request->celtel);
            $vehiculo->observaciones  = strtoupper($request->obs);
            $json = $request->policy;
            $vehiculo->polizas  = json_encode($json);
            $vehiculo->save();
            return redirect('/empresas')->with("mensaje", $mensaje)->with("tipo", $tipo);
        } catch (\Throwable $th) {
            Log::error('se presentó un error al exportar los datos', [$th]);
            return  $th;
        }
    }


   


}
