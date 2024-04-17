@extends('layouts.app', [
    'namePage' => 'SuratMasuk',
    'class' => 'sidebar-mini',
    'activePage' => 'disposisi',
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
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Disposisi</h4>
                    <div class="col-12 mt-2"> <button type="button" class="btn btn-round" style="background-color:#1E90FF;"
                            data-toggle="modal" data-target="#exampleModal">
                            Export
                        </button></div>
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
                                <th>Perihal</th>
                                <th>Ditujukan</th>
                                <th>Instruksi/Informasi</th>
                                <th>Diteruskan Kepada</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disposisi as $index => $data)
                                <tr>
                                    <td>
                                        <center>{{ $index + $disposisi->firstitem() }}</center>
                                    </td>
                                    <td>{{ $data->no_surat }}</td>
                                    <td>{{ $data->tanggal_surat }}</td>
                                    <td>{{ $data->perihal }}</td>
                                    <td>{{ $data->ditujukan }}</td>
                                    <td>{{ $data->isi_disposisi }}</td>
                                    <td>{{ $data->keterangan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('disposisi.show', $data->id) }}" class="btn btn-warning mr-2"
                                            tooltip="" style="color: white;" data-original-title=""
                                            title="">Detail</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
                <div class="d-flex justify-content-end mr-5">{{ $disposisi->links('pagination::bootstrap-4') }}</div>
                <!-- end content-->
            </div>
            <div class="mx-5 pull-right">
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
                    <form action="{{ route('disposisi.ekspor') }}" method="get" class="form-group">
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

@push('js')
    <script>
        function checker() {
            var result = confirm('Yakin Ingin Dihapus?')
            if (result == false) {
                event.preventDefault();
            }
        }
    </script>
@endpush
