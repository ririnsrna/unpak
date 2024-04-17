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
                        <h5 class="title">{{ __('Edit Surat Masuk') }}</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="/updatepostmasuk/{{ $data->id }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('alerts.success')
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __('No Surat') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="no_surat" class="form-control"
                                            value="{{ $data->no_surat }}">
                                        @include('alerts.feedback', ['field' => 'no_surat'])
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{ __('Tanggal Surat') }} <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_surat" class="form-control"
                                            value="{{ $data->tanggal_surat }}">
                                        @include('alerts.feedback', ['field' => 'tanggal_surat'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __(' Pengirim') }}  <span class="text-danger">*</span> </label>
                                        <input type="text" name="pengirim" class="form-control"
                                            value="{{ $data->pengirim }}">
                                        @include('alerts.feedback', ['field' => 'pengirim'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __(' Ditujukan') }}  <span class="text-danger">*</span> </label>
                                        <input type="text" name="ditujukan" class="form-control"
                                            value="{{ $data->ditujukan }}">
                                        @include('alerts.feedback', ['field' => 'ditujukan'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __(' Perihal') }}  <span class="text-danger">*</span></label>
                                        <input type="text" name="perihal" class="form-control"
                                            value="{{ $data->perihal }}">
                                        @include('alerts.feedback', ['field' => 'perihal'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group" class="">
                                        <label>{{ __(' File Surat') }} </label>
                                        <input type="file" name="file" class="form-control" value="">
                                        @include('alerts.feedback', ['field' => 'file'])
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: none;">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __(' Status') }}  <span class="text-danger">*</span></label>
                                        <input type="text" name="status" class="form-control" value="Belum Disposisi">
                                        @include('alerts.feedback', ['field' => 'status'])
                                    </div>
                                </div>
                            </div>
                            <p style="color:black; margin-left: 19px"> Kosongkan jika tidak ada perubahan</p>
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
