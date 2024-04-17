<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Suratkeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SuratKeluarExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuratKeluarAllExport;
use Illuminate\Support\Facades\Storage;
use HnhDigital\LaravelNumberConverter\Facade as NumConvert;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        $pagination  = 5;

        // if($request->date != "" && $request->keyword != ""){
        //     $products    = Suratkeluar::when($request->keyword, function ($query) use ($request) {
        //         $query->where('no_surat', 'like', "%{$request->keyword}%")->where('tanggal_sura', $request->date);
        //         })->orderBy('tanggal_surat', 'asc')->paginate($pagination);
        // }elseif($request->date && $request->date_end) {

        //     $products    = Suratkeluar::when($request->date, function ($query) use ($request) {
        //         $query->where('tanggal_surat', '>=', $request->date);
        //         $query->where('tanggal_surat', '<=', $request->date_end);
        //         })->orderBy('tanggal_surat', 'asc')->paginate($pagination);
        // }else{

        //     $products    = Suratkeluar::when($request->keyword, function ($query) use ($request) {
        //         $query->where('no_surat', 'like', "%{$request->keyword}%");
        //         })->orderBy('tanggal_surat', 'asc')->paginate($pagination);
        // }
        // $products->appends($request->only('keyword'));

        $products    = Suratkeluar::when($request->input('date') && $request->input('date_end'), function ($query) use ($request) {
            $start_date = Carbon::parse($request->input('date'));
            $end_date = Carbon::parse($request->input('date_end'));
            return $query->whereBetween('tanggal_surat', [$start_date, $end_date]);
        })->orderBy('no_surat', 'desc')->paginate($pagination);

        return view('pages.suratkeluar', [
            'products' => $products,

        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function Detail($id)
    {

        $data = Suratkeluar::find($id);
        return view('pages.detailkeluar', compact('data'));
    }

    public function create()
    {
        $data = Suratkeluar::latest()->first();
        $no_surat = Suratkeluar::count();
        if ($no_surat < 10) {
            $no_surat = '00' . $no_surat + 1;
        } else {
            $no_surat = '0' . $no_surat + 1;
        }
        $now = Carbon::now();
        $bulan = $now->month;
        $tahun = $now->year;
        $bulan = NumConvert::roman($bulan);
        return view('form.createkeluar', compact('data', 'no_surat', 'bulan', 'tahun'));
    }

    public function save(Request $request)
    {

        $this->validate($request, [
            'no_surat' => 'required|unique:suratkeluars,no_surat,',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'ditujukan' => 'required',
            'perihal' => 'required',
            'file' => 'required|mimes:pdf,jpeg,jpg,png'

        ]);

        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
        $file->move('assets/file', $file->getClientOriginalName());

        $upload = new Suratkeluar;
        $upload->file = $nama_file;
        $upload->no_surat = $request->no_surat;
        $upload->tanggal_surat = $request->tanggal_surat;
        $upload->pengirim = $request->pengirim;
        $upload->ditujukan = $request->ditujukan;
        $upload->perihal = $request->perihal;
        $upload->status = $request->status;

        $upload->save();

        return redirect('/suratkeluar')->with('status', 'Data Berhasil Di Tambahkan');
    }

    public function edit($id)
    {
        $data = Suratkeluar::find($id);
        return view('form.updatekeluar', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $data = Suratkeluar::find($id);

        $this->validate($request, [
            'no_surat' => 'required',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'ditujukan' => 'required',
            'perihal' => 'required',
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
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'pengirim' => $request->pengirim,
            'ditujukan' => $request->ditujukan,
            'perihal' => $request->perihal,
            'file' => $nama_file
        ]);

        return redirect('/suratkeluar')->with('status', 'Data Berhasil Di Ubah');
    }

    public function editDisposisi($id)
    {
        $disposisi = Suratkeluar::find($id);
        return view('form.disposisikeluar', compact('disposisi'));
    }

    public function updateDisposisi(Request $request, $id)
    {

        $disposisi = Suratkeluar::find($id);

        $this->validate($request, [
            'status' => 'required'
        ]);

        $disposisi->update([
            'status' => $request->status
        ]);

        return redirect('/suratkeluar')->with('status', 'Data Berhasil Di Disposisi');
    }

    public function destroy($id)
    {
        $data = Suratkeluar::find($id);
        $data->delete();
        return redirect('suratkeluar')->with('statusHapus', 'Data Berhasil Di Hapus');
    }

    public function ekspor(Request $request)
    {
        if (!$request->start_date or !$request->end_date) {
            return redirect()->back()->withInput();
        }
        if ($request->start_date && $request->end_date) {
            $suratkeluar = SuratKeluar::whereBetween('tanggal_surat', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $suratkeluar = Suratkeluar::all();
        }

        if ($request->type == 'pdf') {
            $tanggal = Carbon::now();
            $pdf = Pdf::loadView('pdf.keluar', compact('suratkeluar'));
            return $pdf->download('laporan-(' . $tanggal . ').pdf');
        } else {
            if ($request->start_date && $request->end_date) {
                return Excel::download(new SuratKeluarExport($request->start_date, $request->end_date), 'SuratKeluar.xlsx');
            } else {
                return Excel::download(new SuratKeluarAllExport($request->start_date, $request->end_date), 'SuratKeluar.xlsx');
            }
        }
    }
}
