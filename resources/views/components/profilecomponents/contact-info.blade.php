<div class="row">
    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="text" wire:model="contactArray.mainPhone" class="form-control" id="mainphone" placeholder="mainphone" required>
          <label for="mainphone">Main Phone</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="text" wire:model="contactArray.alterPhone" class="form-control" id="alternatephone" placeholder="alternatephone">
          <label for="alternatephone">Alternate Phone</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="text" wire:model="contactArray.mainEmail" class="form-control" id="mainemail" placeholder="mainemail" required>
          <label for="mainemail">Main Email</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
          <input type="text" wire:model="contactArray.alterEmail" class="form-control" id="alternateemail" placeholder="alternateemail">
          <label for="alternateemail">Alternate Email</label>
        </div>
    </div>
</div>