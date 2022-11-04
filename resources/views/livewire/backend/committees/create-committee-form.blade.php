<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-users me-2"></i>Kurul Ekle</h3>
        </div>
        <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-3 text-center">
                        @if(!is_null($logo_url))
                            <img src="{{ $logo_url }}" alt="Logo seçilmedi." width="64px">
                        @else
                            <img src="{{ url('img/committee_no_logo.png') }}" alt="Logo seçilmedi." width="64px">
                        @endif
                    </div>
                    <div class="col-9">
                        <div class="form-label">Kurul Logosu</div>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" wire:model="photo" id="photo">
                        <div class="invalid-feedback">@error('photo') {{$message}} @enderror</div>
                    </div>
                </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="floating-input-name" autocomplete="off" wire:model.lazy="name">
                        <label for="floating-input-name">Kurul Adı</label>
                        <div class="invalid-feedback">@error('name') {{$message}} @enderror</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floating-input-slug" autocomplete="off" wire:model.defer="slug" disabled="disabled">
                    <label for="floating-input-slug" class="ms-1">İçerik Bağlantısı</label>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="form-floating mb-3">
                        <select class="form-select @error('has_page') is-invalid @enderror" wire:model="has_page" id="floatingSelect1">
                            <option selected="">Seçiniz...</option>
                            <option value="1">Dahili Sayfa</option>
                            <option value="0">Harici Link</option>
                        </select>
                        <label for="floatingSelect1">İçerik Türü</label>
                        <div class="invalid-feedback">@error('has_page') {{$message}} @enderror</div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="floating-input-order" autocomplete="off" wire:model.lazy="order">
                        <label for="floating-input-order">Sıra</label>
                        <div class="invalid-feedback">@error('order') {{$message}} @enderror</div>
                    </div>
                </div>
            </div>
            @if(!is_null($has_page))
                @if($has_page==1)
                    <div class="row">
                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" wire:model.lazy="description" id="floating-input2"></textarea>
                            <label for="floating-input2" class="ms-1">Açıklama</label>
                            <div class="invalid-feedback">@error('description') {{$message}} @enderror</div>
                        </div>
                    </div>
                @elseif($has_page==0)
                    <div class="row">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('external_url') is-invalid @enderror" id="floating-input3" autocomplete="off" wire:model.lazy="external_url">
                            <label for="floating-input3" class="ms-1">Harici Bağlantı</label>
                            <div class="invalid-feedback">@error('external_url') {{$message}} @enderror</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('external_url_title') is-invalid @enderror" id="floating-input4" autocomplete="off" wire:model.lazy="external_url_title">
                            <label for="floating-input4" class="ms-1">Harici Bağlantı Başlığı</label>
                            <div class="invalid-feedback">@error('external_url_title') {{$message}} @enderror</div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="card-footer text-end">
            <button class="btn btn-muted" wire:click="clearForm">İptal</button>
            <button class="btn btn-success" wire:click="storeCommittee" wire:loading.attr="disabled">
                <div class="spinner-border spinner-border-sm me-2" role="status" wire:loading wire:target="storeCommittee">
                    <span class="sr-only">Yükleniyor...</span>
                </div>
                Kaydet
            </button>
        </div>
    </div>
</div>
