


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            Comentario: <strong>{{ $postComment->title }}</strong>
        </h4>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="url_clean">Usuario</label>
            <input readonly class="form-control" type="text" value="{{ $postComment->user->name }}">
        </div>
        <div class="form-group">
            <label for="url_clean">Aprovado</label>
            <input readonly class="form-control" type="text" value="{{ $postComment->approved }}">
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea readonly class="form-control" rows="3">{{ $postComment->message }}</textarea>
        </div>
    </div>
</div>



