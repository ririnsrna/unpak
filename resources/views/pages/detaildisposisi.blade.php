@extends('layouts.app', [
    'namePage' => 'DetailDisposisi',
    'class' => 'sidebar-mini',
    'activePage' => '',
])

@section('content')
    <div class="panel-header-nifa">
    </div>




    <div class="container mt-5">


        <div class="card" style="width: 50rem;">
            <div class="card-body d-flex">
                <object type="application/pdf" data="{{ asset('assets/file/' . $data->file) }}" width="600"
                    height="400"></object>
                <ul style="list-style:none;">
                    <br>
                    <br>
                    <br>

                    <li class="mb-3">No Surat : {{ $data->no_surat }}</li>
                    <li class="mb-3">Perihal : {{ $data->tanggal_surat }}</li>
                    <li class="mb-3">Ditujukan : {{ $data->ditujukan }}</li>
                    <li class="mb-3">Instruksi/Informasi : {{ $data->isi_disposisi }}</li>
                    <li class="mb-3">Diteruskan kepada : {{ $data->keterangan }}</li>
                    <li class="mb-3">Tanggal Surat : {{ $data->tanggal_surat }}</li>
                    {{-- <!-- <li class="mb-3">Status : {{ $data->status }}</li> --> --}}
                    <li class="mb-3">File : {{ $data->file }}</li>
                </ul>
            </div>
            <div class="container d-flex" style="justify-content:center; align-items:center;">
                <a href="{{ route('disposisi.edit', $data->id) }}" class="btn btn-warning " tooltip=""
                    style="color: white;" data-original-title="" title="">Edit</a>
            </div>
            <a href="/disposisi" class="bg-secondary btn ml-3">Kembali</a>
        </div>
        </center>
    </div>
    </div>
    </center>
@endsection


@push('js')
    <script>
        function checker() {
            var result = confirm('Yakin Ingin Dihapus?');
            if (result == false) {
                event.preventDefault();
            }
        }
    </script>
@endpush
