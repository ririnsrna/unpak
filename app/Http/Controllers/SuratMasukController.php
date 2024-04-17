<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Disposisi;
use App\Models\Suratmasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SuratMasukExport;
use App\Exports\SuratMasukAllExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {

        $pagination  = 5;
        $productss    = Suratmasuk::when($request->input('date') && $request->input('date_end'), function ($query) use ($request) {
            $start_date = Carbon::parse($request->input('date'));
            $end_date = Carbon::parse($request->input('date_end'));
            return $query->whereBetween('tanggal_surat', [$start_date, $end_date]);
        })->orderBy('created_at', 'desc')->paginate($pagination);


        // $productss->when(, function ($query) use ($request) {

        // });

        // $productss->appends($request->only('keyword'));

        return view('pages.suratmasuk', [
            'productss' => $productss,
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function Detail($id)
    {

        $data = Suratmasuk::find($id);
        return view('pages.detail', compact('data'));
    }

    public function create()
    {

        return view('form.createmasuk');
    }

    public function save(Request $request)
    {

        $this->validate($request, [
            'no_surat' => 'required|unique:suratmasuks,no_surat,',
            'tanggal_surat' => 'required',
            'pengirim' => 'required',
            'ditujukan' => 'required',
            'perihal' => 'required',
            'file' => 'required|mimes:pdf,jpeg,jpg,png'
        ]);

        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
        $file->move('assets/file', $file->getClientOriginalName());

        $upload = new Suratmasuk;
        $upload->file = $nama_file;
        $upload->no_surat = $request->no_surat;
        $upload->tanggal_surat = $request->tanggal_surat;
        $upload->pengirim = $request->pengirim;
        $upload->ditujukan = $request->ditujukan;
        $upload->perihal = $request->perihal;
        $upload->keterangan = $request->keterangan;
        $upload->tanggapan = $request->tanggapan;
        $upload->status = $request->status;

        $upload->save();

        return redirect('/suratmasuk')->with('status', 'Data Berhasil Di Tambahkan');
    }

    public function edit($id)
    {
        $data = Suratmasuk::find($id);
        return view('form.updatemasuk', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $data = Suratmasuk::find($id);
        $disposisi = Disposisi::where('no_surat', $data->no_surat);

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

        $disposisi->update([
            'no_surat' =>$data->no_surat,
            'tanggal_surat' =>$data->tanggal_surat,
            'perihal' =>$data->perihal,
            'ditujukan' =>$data->ditujukan,
            'file' =>$data->file,
        ]);

        return redirect('/suratmasuk')->with('status', 'Data Berhasil Di Ubah');
    }
    public function editDisposisi($id)
    {
        $disposisi = Suratmasuk::find($id);
        return view('form.disposisimasuk', compact('disposisi'));
    }

    public function updateDisposisi(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'keterangan' => 'required',
            'isi_disposisi' => 'required',
        ]);

        $disposisi = Suratmasuk::find($id);


        if ($request->status == 'Belum Disposisi') {
            return redirect()->route('disposisi.create', $disposisi->id)->with('error', 'Status wajib sudah disposisi!')->withInput();
        }
        $disposisi->update([
            'status' => 'Sudah Disposisi'
        ]);

        Disposisi::create([
            'no_surat' => $disposisi->no_surat,
            'perihal' => $disposisi->perihal,
            'ditujukan' => $disposisi->ditujukan,
            'isi_disposisi' => $request->isi_disposisi,
            'keterangan' => $request->keterangan,
            'tanggal_surat' => $disposisi->tanggal_surat,
            'file' => $disposisi->file,
        ]);
        return redirect('/suratmasuk')->with('status', 'Data Berhasil Di Disposisi');
    }

    public function destroy($id)
    {
        $data = Suratmasuk::find($id);
        if ($data->status == 'Sudah Disposisi') {
            $disposisi = Disposisi::where('no_surat', $data->no_surat)->first();
            $disposisi->delete();
        };
        $data->delete();
        return redirect('suratmasuk')->with('statusHapus', 'Data Berhasil Di Hapus');
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
            $suratmasuk = SuratMasuk::whereBetween('tanggal_surat', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $suratmasuk = SuratMasuk::all();
        }

        if ($request->type == 'pdf') {
            $tanggal = Carbon::now();
            $pdf = Pdf::loadView('pdf.masuk', compact('suratmasuk'));
            return $pdf->download('laporan-(' . $tanggal . ').pdf');
            return redirect('/suratmasuk');
        } else {
            if ($request->start_date && $request->end_date) {
                
                return Excel::download(new SuratMasukExport($request->start_date, $request->end_date), 'SuratMasuk.xlsx');
            } else {
                return Excel::download(new SuratMasukAllExport(), 'SuratMasuk.xlsx');
            }
            return redirect('/suratmasuk');
        }
    }
}
