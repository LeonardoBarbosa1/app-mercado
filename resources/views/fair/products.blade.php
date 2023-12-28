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

                <div class="bg-light p-3" style="margin-top: 20px;">
                    <form action="{{ route('product-search', ['id' => $fair->id]) }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input class="form-control mr-sm-2" type="search" name="product_search" placeholder="Digite sua pesquisa" aria-label="Pesquisar">
                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                        </div>
                    </form>
                </div>

                <div class="card" >
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Produtos da feira: {{ $fair->name }}
                            </div>

                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('product.create')}}" class="btn btn-success mb-2 mb-sm-0"
                                       data-toggle="modal" data-target="#myModal">
                                        +
                                    </a>

                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                         aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                @include('products/create')
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 350px;">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Quanti.</th>
                                    <th scope="col">Preço</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $product['name'] }}</td>
                                        <td>{{ $product['quantity'] }}</td>
                                        <td>{{ $product['price'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="border-top: none;">
                                            @if($product->status == false)
                                                <span
                                                    class="text-warning fw-bold">Pend.</span>
                                            @else
                                                <span
                                                    class="text-success fw-bold">Concl.</span>
                                            @endif
                                        </td>


                                        <td style="border-top: none;">
                                            <a href="" class="btn btn-primary mb-2 mb-sm-0"
                                               data-toggle="modal" data-target="#myModal_{{$product->id}}">
                                                <i class="fa fa-edit "></i>
                                            </a>

                                            <div class="modal fade"
                                                 id="myModal_{{$product->id}}"
                                                 tabindex="-1"
                                                 role="dialog"
                                                 aria-labelledby="myModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        @include('products/update')
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td style="border-top: none;">
                                            <a href="" class="btn btn-danger mb-2 mb-sm-0"
                                               data-toggle="modal" data-target="#myModal_delete_{{$product->id}}">
                                                <i class="fa fa-trash "></i>
                                            </a>

                                            <div class="modal fade"
                                                 id="myModal_delete_{{$product->id}}"
                                                 tabindex="-1"
                                                 role="dialog"
                                                 aria-labelledby="myModalLabel"
                                                 aria-hidden="true"
                                                 style="margin-top: 100px"
                                            >

                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        @include('products/delete')
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div>
                            <i class="fa fa-calculator"></i>
                            <span class="h4">Total:</span><span class="h2"> R${{ $total }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <footer class="text-center mt-4" style="color: #999;">
        &copy; Leonardo Barbosa - V.1.0.0
    </footer>
@endsection

