<div class="modal-body">
    <div class="card-body">
        <form id="form_{{ $product->id }}" method="post" action="{{ route('product.destroy', ['product' => $product]) }}">
            @method('DELETE')
            @csrf
            <div class="mb-3">
                <h5 class="h5">Tem certeza que deseja excluir esse Produto?</h5>
                <p class="text-muted">Essa ação é irreversível.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" href="#" onclick="document.getElementById('form_{{ $product->id }}').submit()">
                    Sim, Excluir
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
