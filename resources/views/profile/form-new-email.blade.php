@extends('adminlte::page')

@section('content')
    <div class="container" >

            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="margin-top: 100px;">
                        <div class="card-header">{{ __('Alterar Email') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('update-email') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="current-email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Email Atual') }}</label>

                                    <div class="col-md-6">
                                        <input id="current-email" type="email" value="{{ __($user->email) }}"
                                               class="form-control" name="current-email" required
                                               autocomplete="current-email" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Novo Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               name="email" required autocomplete="new-email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Alterar Email') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection

