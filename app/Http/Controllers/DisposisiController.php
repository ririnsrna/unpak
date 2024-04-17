<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Disposisi;
use App\Models\Suratmasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DisposisiExport;
use App\Exports\DisposisiAllExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class DisposisiController extends Controller
{
    public function index(Request $request)
    {
        $pagination  = 5;
        $disposisi    = Disposisi::when($request->keyword, function ($query) use ($request) {
            $query->where('no_surat', 'or', 'ditujukan', 'or', 'pengirim', 'like', "%{$request->keyword}%");
        })->orderBy('created_at', 'desc')->paginate($pagination);

        $disposisi->appends($request->only('keyword'));

        return view('pages.disposisi', [
            'disposisi' => $disposisi,
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function destroy($id)
    {
        $data = Disposisi::find($id);
        $suratmasuk = Suratmasuk::where('no_surat', $data->no_surat)->first();
        $suratmasuk->update([
            'status' => 'Belum Disposisi',
        ]);
        $data->delete();
        return redirect('disposisi')->with('statusHapus', 'Data Berhasil Di Hapus');
    }

    public function ekspor(Request $request)
    {
        if (!$request->start_date && !$request->end_date) {
            return redirect()->back()->withErrors([
                'start_date' => 'Tanggal awal tidak boleh dikosongkan',
                'end_date' => 'Tanggal akhir tidak boleh dikosongkan',
            ]);
        }

        if ($request->start_date && $request->end_date) {
            $disposisi = Disposisi::whereBetween('tanggal_surat', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $disposisi = Disposisi::all();
        }

        if ($request->type == 'pdf') {
            $tanggal = Carbon::now();
            $pdf = Pdf::loadView('pdf.disposisi', compact('disposisi'));
            return $pdf->download('laporan-(' . $tanggal . ').pdf');
            return redirect('/disposisi');
        } else {
            if ($request->start_date && $request->end_date) {
                return Excel::download(new DisposisiExport($request->start_date, $request->end_date), 'Disposisi.xlsx');
            } else {
                return Excel::download(new DisposisiAllExport(), 'Disposisi.xlsx');
            }
            return redirect('/disposisi');
        }

    }

    public function edit($id)
    {
        $data = Disposisi::find($id);
        return view('form.updatedisposisi', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Disposisi::find($id);

        $request->validate([
            'keterangan' => 'required',
            'isi_disposisi' => 'required',
            'file' => 'mimes:pdf,jpeg,jpg,png'

        ]);

        if ($request->file('file')) {
            $oldFile = $data->file;
            Storage::delete('assets/file/' . $oldFile);

            $file = $request->file('file');
            $nama_file = $file->getClientOriginalName();
            $file->move('assets/file', $file->getClientOriginalName());
        } else {
            $nama_file = $data->file;
        }

        $data->update([
            'isi_disposisi' => $request->isi_disposisi,
            'keterangan' => $request->keterangan,
            'file' => $nama_file
        ]);

        return redirect()->route('pages.disposisi')->with('status', 'Data berhasil diedit!');
    }

    public function show($id)
    {
        $data = Disposisi::where('id', $id)->first();
        return view('pages.detaildisposisi', compact('data'));
    }
}
