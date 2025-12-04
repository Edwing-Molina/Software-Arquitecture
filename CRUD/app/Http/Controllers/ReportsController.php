<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class ReportsController extends Controller
{
    public function viewReport()
    {
        return view('admin.report');
    }

    public function fetchSalesData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $dailyReport = $request->input('daily_report');

        if ($dailyReport) {
            $ventas = DB::table('pedidos')
                ->whereDate('created_at', $dailyReport)
                ->get();
        } else {
            $ventas = DB::table('pedidos')
                ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->get();
        }

        return $this->generateReport($ventas);
    }

    public function generateReport($ventas)
    {
        $datos = [
            'titulo' => 'Reporte de Ventas',
            'fecha' => date('d/m/Y'),
            'ventas' => $ventas 
        ];
        $pdf = Pdf::loadView('reportPDF', $datos);
        return $pdf->download('reporte.pdf');
    }

}
