@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'User Profile',
    'activePage' => 'profile',
    'activeNav' => '',
])

@section('content')
    <div class="panel-header-nifa">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <form method="post" action="{{ route('profile.update') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-header">
                            <h5 class="title">{{ __(' Edit Profile') }}</h5>
                        </div>
                        <div class="card-body">
                            @include('alerts.success')
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="nama">{{ __(' Nama') }}</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('nama', auth()->user()->name) }}">
                                        @include('alerts.feedback', ['field' => 'nama'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label for="email">{{ __(' Alamat Email') }}</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            value="{{ old('email', auth()->user()->email) }}">
                                        @include('alerts.feedback', ['field' => 'email'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h5 class="title">{{ __('Password') }}</h5>
                            <small>Kosongkan jika tidak ada perubahan</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __(' Kata Sandi Baru') }}</label>
                                        <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Masukan Kata Sandi Baru') }}" type="password"
                                            name="password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <label>{{ __(' Komfirmasi Kata Sandi Baru') }}</label>
                                        <input class="form-control" placeholder="{{ __('Konfirmasi Kata Sandi Baru') }}"
                                            type="password" name="password_confirmation">

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-warning btn-round ">{{ __('Ubah Profile') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
