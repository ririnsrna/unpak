@extends('layouts.app', [
    'namePage' => 'DetailKeluar',
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
                    <li class="mb-3">Tanggal Surat : {{ $data->tanggal_surat }}</li>
                    <li class="mb-3">Pengirim : {{ $data->pengirim }}</li>
                    <li class="mb-3">Ditujukan : {{ $data->ditujukan }}</li>
                    <li class="mb-3">Perihal : {{ $data->perihal }}</li>
                    {{-- <!-- <li class="mb-3">Status : {{ $data->status }}</li> --> --}}
                    <li class="mb-3">File : {{ $data->file }}</li>
                </ul>
            </div>
            <div class="container d-flex" style="justify-content:center; align-items:center;">
                <a href="/updatekeluar/{{ $data->id }}" class="btn btn-warning " tooltip="" style="color: white;"
                    data-original-title="" title="">Edit</a>
                <form method="post">
                    <a onclick="checker()" type="button" href="/deletekeluar/{{ $data->id }}" rel="tooltip" class="btn btn-danger ml-3"
                        style="color: white;" data-original-title="" title="">
                        Hapus
                    </a>
                </form>
            </div>
            <a href="/suratkeluar" class="bg-secondary btn ml-3">Kembali</a>
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
