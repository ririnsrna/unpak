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
                                        value="{{ old('nama', auth()->user()->name) }}" disabled>
                                    @include('alerts.feedback', ['field' => 'nama'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label for="email">{{ __(' Alamat Email') }}</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email"
                                        value="{{ old('email', auth()->user()->email) }}" disabled>
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('password.confirm') }}" class="btn btn-secondary btn-rounded">Ubah Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
