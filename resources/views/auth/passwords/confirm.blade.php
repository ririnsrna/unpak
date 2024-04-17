@extends('layouts.app', [
    'namePage' => '',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'login',
    'backgroundImage' => asset('assets') . '/img/bgbgbg.png',
])
@section('content')
    <div class="content">
        <div class="container justify-content-center">
            <div class="row">
                <div class="col-md-12 ml-auto mr-auto">
                    <div class="header bg-gradient-primary py-10 py-lg-2 pt-lg-12">
                        <div class="container">
                            <div class="header-body text-center mb-7">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12 col-md-9">
                                        <p class="text-lead text-light mt-3 mb-0">
                                            @include('alerts.migrations_check')
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 ml-auto mr-auto justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Konfirmasi Password') }}</div>

                            <div class="card-body">
                                {{ __('Konfirmasi password sebelum melanjutkan.') }}

                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-secondary">
                                                {{ __('Konfirmasi') }}
                                            </button>

                                            {{-- @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
