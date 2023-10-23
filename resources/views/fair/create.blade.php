<?php
    use App\Models\Fair;

?>
<div class="modal-header">
    <h5 class="modal-title" id="myModalLabel">Cadastrar Feira</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('fair.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="nome..." required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Data</label>
            <input type="date" class="form-control @error('data_fair') is-invalid @enderror" name="date_fair" required value="dd/mm/aaaa">
            @error('date_fair')
            <span class="invalid-feedback" role="alert">
                O campo Data é obrigatório!
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-control" name="status">
                @foreach(Fair::$statusOptions as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
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
