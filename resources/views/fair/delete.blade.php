<div class="modal-body">
    <div class="card-body">
        <form id="form_{{ $fair->id }}" method="post" action="{{ route('fair.destroy', ['fair' => $fair->id]) }}">
            @method('DELETE')
            @csrf
            <div class="mb-3">
                <h5 class="h5">Tem certeza que deseja excluir essa feira?</h5>
                <p class="text-muted">Essa ação é irreversível.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" href="#" onclick="document.getElementById('form_{{ $fair->id }}').submit()">
                    Sim, Excluir
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
