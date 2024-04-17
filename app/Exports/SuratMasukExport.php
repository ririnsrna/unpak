<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SuratMasukExport implements FromView
{
    use Exportable;

    public function __construct(string $start_date, string $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        
        return $this;
    }

    public function view(): View
    {
        $suratmasuk = SuratMasuk::query()->whereBetween('tanggal_surat', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59'])->get();
        return view('excel.suratmasuk', [
            'suratmasuk' => $suratmasuk,
        ]);
    }

}