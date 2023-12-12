<?php
/* @var $fair \App\Models\Fair */

?>

<div class="modal-header">
    <h5 class="modal-title" id="myModalLabel">Cadastrar Produto</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('product.update', ['product' => $product]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   placeholder="nome..." required value="{{ $product->name }}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <input type="text" class="form-control @error('brand') is-invalid @enderror" name="brand"
                   placeholder="marca..." value="{{ $product->brand }}">
            @error('brand')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Quantidade</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                   id="quantity" size="30" maxlength="4000" required value="{{ $product->quantity }}">
            @error('quantity')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Valor</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">R$</span>
                </div>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                       required value="{{ $product->price }}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-check">
                <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" name="status"
                       id="status" value="1" @if($product->status) checked @endif>
                <label class="form-check-label" for="status">
                    Concluído
                </label>
            </div>
            @error('status')
            <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
            @enderror
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>

    </form>
</div>
