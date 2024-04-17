@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'User Profile',
    'activePage' => 'surat-masuk',
    'activeNav' => '',
])

@section('content')
    <div class="panel-header-nifa">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Disposisi Surat') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/disposisipostmasuk/{{ $disposisi->id }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('alerts.success')
                            @if (session($key ?? 'error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session($key ?? 'error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __(' Status') }}  <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="Belum Disposisi">Belum Disposisi</option>
                                            <option value="Sudah Disposisi">Sudah Disposisi</option>
                                        </select>
                                        @if (session('error'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ session('message') }}</strong>
                                            </span>
                                        @endif
                                        @include('alerts.feedback', ['field' => 'status'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __('Instruksi/Informasi') }}  <span class="text-danger">*</span></label>
                                        <input type="text" name="isi_disposisi" id="isi_disposisi" class="form-control"
                                            value="{{ old('isi_disposisi') }}">
                                        @include('alerts.feedback', ['field' => 'isi_disposisi'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __('Diteruskan Kepada') }}  <span class="text-danger">*</span></label>
                                        <input type="text" name="keterangan" class="form-control " id="keterangan"
                                            value="{{ old('keterangan') }}" />

                                        @include('alerts.feedback', ['field' => 'keterangan'])
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <a href="{{ route('pages.suratmasuk') }}" class="btn btn-secondary btn-round">Kembali</a>
                                <button type="submit" class="btn btn-info btn-round">{{ __('Simpan') }}</button>
                            </div>
                            <hr class="half-rule" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
