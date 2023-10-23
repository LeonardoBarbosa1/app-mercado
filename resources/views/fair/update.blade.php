<?php
use App\Models\Fair;

?>
<div class="modal-header">
    <h5 class="modal-title" id="myModalLabel">Atualizar Feira</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form method="POST" action="{{ route('fair.update', ['fair' => $fair]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   name="name"
                   placeholder="nome..."
                   value="{{ $fair->name ?? '' }}"
                   required >
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Data</label>
            <input type="date"
                   class="form-control @error('date_fair') is-invalid @enderror"
                   name="date_fair"
                   required
                   value="{{ $fair->date_fair ? date('Y-m-d', strtotime($fair->date_fair)) : '' }}"
            >

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
                    <option value="{{ $key }}" {{  $fair->status == $key ? 'selected' : '' }}> {{ $value }}</option>
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
