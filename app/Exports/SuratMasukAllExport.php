<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SuratMasukAllExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        $suratmasuk = SuratMasuk::all();
        return view('excel.suratmasuk', [
            'suratmasuk' => $suratmasuk,
        ]);
    }

}