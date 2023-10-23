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
                    <div class="card-header">{{ __('Alterar Nome') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update-name') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="current-name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nome Atual') }}</label>

                                <div class="col-md-6">
                                    <input id="current-name" value="{{ __($user->name) }}"
                                           class="form-control" name="current-name" required
                                           autocomplete="current-name" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Novo Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name" required autocomplete="new-name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Alterar Nome') }}
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

