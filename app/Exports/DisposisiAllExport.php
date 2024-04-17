<?php

namespace App\Exports;

use App\Models\Disposisi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class DisposisiAllExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        return view('excel.disposisi', [
            'disposisi' => Disposisi::all(),
        ]);
    }

}