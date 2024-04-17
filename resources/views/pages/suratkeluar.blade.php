@extends('layouts.app', [
    'namePage' => 'SuratKeluar',
    'class' => 'sidebar-mini',
    'activePage' => 'surat-keluar',
])

@section('content')
    <div class="panel-header-nifa">
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @elseif(session('statusHapus'))
                <div class="alert alert-danger">
                    {{ session('statusHapus') }}
                </div>
            @elseif(session('statusUbah'))
                <div class="alert alert-primary">
                    {{ session('statusUbah') }}
                </div>
            @elseif(session('statusDisposisi'))
                <div class="alert alert-secondary">
                    {{ session('statusDisposisi') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Surat Keluar</h4>
                    <a class="btn btn-success btn-round text-white pull-left"
                        href="{{ route('suratkeluar.create') }}">Tambah Surat</a>
                    <button type="button" class="btn btn-round btn-primary" style="background-color:#1E90FF;"
                        data-toggle="modal" data-target="#exampleModal">
                        Export
                    </button>
                    <div class="col-12 mt-2">
                    </div>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>

                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Surat</th>
                                <th>Tanggal</th>
                                {{-- <th>Status</th> --}}
                                <th>Pengirim</th>
                                <th>Ditujukan</th>
                                <th>Perihal</th>
                                <th class="">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $data)
                                <tr>
                                    <td>
                                        <center>{{ $index + $products->firstitem() }}</center>
                                    </td>
                                    <td>{{ $data->no_surat }}</td>
                                    <td>{{ $data->tanggal_surat }}</td>
                                    <td>{{ $data->pengirim }}</td>
                                    <td>{{ $data->ditujukan }}</td>
                                    <td>{{ $data->perihal }}</td>
                                    <td class="" style="display:flex; justify-content:space-between;">
                                        <a type="button" href="/detailkeluar/{{ $data->id }}" rel="tooltip"
                                            class="btn btn-warning text-center  " style="color: black; align-items:center;"
                                            data-original-title="" title="">Detail
                                            <i class=""></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

                <!-- end content-->
                <div class="d-flex justify-content-end mr-5">{{ $products->links('pagination::bootstrap-4') }}</div>
            </div>
            <div class="pull-right mr-5">
            </div>
            <!--  end card  -->
        </div>


        <!-- end col-md-12 -->




    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ekspor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('suratkeluar.ekspor') }}" method="get" class="form-group">
                        <label class="mt-2" for="start_date">Tanggal Awal</label>
                        <input class="mt-n1 form-control" type="date" name="start_date" id="start_date">
                        <div>
                            <small class="text-secondary">
                                Tanggal awal tidak boleh kosong
                            </small>
                        </div>
                        <label class="mt-2" for="end_date">Tanggal Akhir</label>
                        <input class="mt-n1 form-control" type="date" name="end_date" id="end_date">
                        <div>
                            <small class="text-secondary">
                                Tanggal akhir tidak boleh kosong
                            </small>
                        </div>
                        <label class="mt-2" for="type">Tipe</label>
                        <select class="mt-n1 form-control" name="type" id="type">
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                        </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-1">Ekspor</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
