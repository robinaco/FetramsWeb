<?php

namespace App\Exports;

use App\Models\Poliza;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;  
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;


class PolizasExport implements FromCollection,WithHeadings ,  WithStyles,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $type = DB::table('polizas')
        ->join('empresas', 'empresas.id', '=', 'polizas.idempresa')
        ->select('polizas.id','polizas.idempresa','empresas.nombreusuario'
        ,DB::raw('(CASE WHEN empresas.estado =  0  THEN "INACTIVA" ELSE "ACTIVA" END) AS ESTADO'),
        'polizas.aseguradora','polizas.version','polizas.tipopoliza','polizas.numpoliza','polizas.numanexo',
        'polizas.numcertificado','polizas.numriesgo','polizas.tipodocumento','polizas.fechaexpedicion',
        'polizas.sucursarexp','polizas.hoursin','polizas.fechavigini','polizas.fechavigfin','polizas.hoursfin','polizas.obs',
        DB::raw('(CASE WHEN polizas.estado =  0  THEN "INACTIVA" ELSE "ACTIVA" END) AS Estado_Poliza'),'polizas.created_at','polizas.updated_at')
        ->get();
    return $type;
    }



    public function headings(): array
    {
        return [
            'Id_Poliza',
            'Id_Empresa',
            'Razon_Social_Empresa',
            'Estado_Registro_Empresa',
            'Nombre_Aseguradora',
            'Numero_Version',
            'Tipo_Poliza',
            'Numero_Poliza',
            'Numero_Anexo',
            'Numero_Certificado',
            'Numero_Riesgo',
            'Tipo_Documento',
            'Fecha_Expedicion_Poliza',
            'Sucursal_Expedicion',
            'Hora_Inicial_Vigencia',
            'Fecha_Inicial_Vigencia',
            'Fecha_Final_Vigencia',
            'Hora_Final_Vigencia',
            'Observaciones',
            'Estado_Registro_Poliza',  
            'Fecha_Registro_Poliza', 
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
        return  date('Y-m-d').'_Informe_Detalle_Polizas' ;
    }
}
