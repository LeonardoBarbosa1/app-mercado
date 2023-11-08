<?php

use App\Models\Fair;

$fairStatus = Fair::$statusOptions;
?>

@extends('adminlte::page')

@section('content')
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('error') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Histórico de Compras
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($fairs as $key => $fair)
                                    <tr>
                                        <td>{{ $fair['name'] }}</td>
                                        <td>{{ date('d/m/Y', strtotime($fair['date_fair'])) }}</td>
                                        <td>
                                            @if($fair->status)
                                                @if($fair->status == Fair::STATUS_PENDING)
                                                    <span
                                                        class="text-warning fw-bold">{{  $fairStatus[$fair->status] }}</span>
                                                @elseif ($fair->status == Fair::STATUS_COMPLETED)
                                                    <span
                                                        class="text-success fw-bold">{{  $fairStatus[$fair->status] }}</span>
                                                @elseif ($fair->status == Fair::STATUS_CANCELED)
                                                    <span
                                                        class="text-danger fw-bold">{{  $fairStatus[$fair->status] }}</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: none;">
                                            <i class="fa fa-calculator"></i>
                                            <span> Total: R${{ $fairTotals[$fair->id] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $fairs->previousPageUrl()}}" aria-label="Previous">
                                        <span aria-hidden="true">Voltar</span>
                                    </a>
                                </li>

                                @for ($i = 1; $i <= $fairs->lastPage(); $i++)
                                    <li class="page-item {{ $fairs->currentPage() == $i ? 'active' : ''}} ">
                                        <a class="page-link" href="{{ $fairs->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor


                                <li class="page-item">
                                    <a class="page-link" href="{{ $fairs->nextPageUrl()}}" aria-label="Next">
                                        <span aria-hidden="true">Avançar</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <footer class="text-center mt-4" style="color: #999;">
        &copy; Leonardo Barbosa - V.1.0.0
    </footer>
@endsection

