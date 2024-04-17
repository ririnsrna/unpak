<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SuratKeluarExport implements FromView
{
    use Exportable;

    public function __construct(string $start_date, string $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function view(): View
    {
        return view('excel.suratkeluar', [
            'suratkeluar' => SuratKeluar::query()->whereBetween('tanggal_surat', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])->get()
        ]);
    }

}