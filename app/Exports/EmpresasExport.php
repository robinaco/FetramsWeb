<?php

namespace App\Exports;

use App\Models\Empresa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;



class EmpresasExport implements FromCollection, WithHeadings, WithStyles, WithTitle 
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $type = DB::table('empresas')
            ->leftJoin('archivos', 'empresas.id', '=', 'archivos.idempresa')
            ->select('empresas.created_at', 'empresas.id', 'empresas.nombreusuario', 'tipodocto', 'documento', 'direccion', 'email', 'presidente', 'municipio', 'telefono', 'habilitacion', 'permiso', 'empresas.updated_at',DB::raw('(CASE WHEN empresas.estado =  0  THEN "INACTIVA" ELSE "ACTIVA" END) AS ESTADO'),'archivos.idempresa', 'archivos.namefile')
            ->get();
        return $type;
    }


    public function headings(): array
    {
        return [
            'fecha_registro',
            'id_empresa',
            'nombre_empresa',
            'tipo_documento',
            'numero_documento',
            'direccion',
            'email',
            'rep_legal',
            'municipio',
            'telefono',
            'habilitacion',
            'permiso',
            'fecha_ultima_actualizacion',
            'Estado_Registro_Empresa',
            'id_empresa_adjunto',
            'adjunto_cargado',

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
        return  date('Y-m-d').'_Informe_Empresas' ;
    }
}
