<?php

namespace App\Exports;

use App\Models\Vehiculo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;


class VehiculosExport implements FromCollection, WithHeadings ,  WithStyles,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $type = DB::table('vehiculos')
            ->join('marcas', 'marcas.id', '=', 'vehiculos.marca')
            ->join('empresas', 'empresas.id', '=', 'vehiculos.idempresa')
            ->select('vehiculos.id','marcas.descripcion','vehiculos.idempresa',
                    'empresas.nombreusuario', 'vehiculos.modelo', 'vehiculos.placa', 
                    'vehiculos.kilometros','vehiculos.chasis', 'vehiculos.motor','vehiculos.numatricula','vehiculos.tservicio',
                    'vehiculos.tecnomec','vehiculos.numsoat','vehiculos.lconduccion',
                    'vehiculos.propietario', 'vehiculos.docpropietario','vehiculos.celular',
                    'vehiculos.observaciones','vehiculos.polizas',DB::raw('(CASE WHEN vehiculos.estado =  0  THEN "INACTIVO" ELSE "ACTIVO" END) AS ESTADO'), 
                    'vehiculos.created_at', 'vehiculos.updated_at')
            ->get();
        return $type;
    }



    public function headings(): array
    {
        return [
            'Id_Vehiculo',
            'Marca',
            'Id_empresa',
            'Nombre_empresa',
            'Modelo',
            'Placa',
            'Kilometros',
            'Chasis',
            'Motor',
            'Numero_matricula',
            'Tipo_servicio',
            'Certificado_Tecnicomecanica',
            'Numero_soat',
            'Licencia_conduccion',
            'Nombre_propietario',
            'Documento_propietario',
            'Numero_celular_propietario',
            'Observaciones',  
            'Polizas_Asociadas_al_Vehiculo', 
            'Estado_Registro', 
            'Fecha_Creacion_Registro', 
            'Fecha_Ultima_Actualizacion_Registro', 

        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]

        ];
    }

    public function title(): string
    {
        return  date('Y-m-d').'_Informe_Detalle_Vehiculos' ;
    }
}
