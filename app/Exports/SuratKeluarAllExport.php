<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SuratKeluarAllExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('excel.suratkeluar', [
            'suratkeluar' => SuratKeluar::all(),
        ]);
    }

}