<div class="row">
    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="text" wire:model.defer="rpArray.title" class="form-control" id="title" placeholder="title" required>
          <label for="title">Title</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="text" wire:model.defer="rpArray.url" class="form-control" id="url" placeholder="url" required>
          <label for="urlname">Url</label>
        </div>
    </div>

</div>