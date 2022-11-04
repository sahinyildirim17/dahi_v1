<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-users me-2"></i>Kurul Yönetimi</h3>
        </div>
        <div class="card-body p-0">
            @if(count($committees)>0)
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th class="w-1 text-center">#</th>
                            <th class="w-1 text-center">LOGO</th>
                            <th class="text-center">KURUL ADI</th>
                            <th class="w-1 text-center">ÜYE SAYISI</th>
                            <th class="w-2 text-center">İŞLEMLER</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($committees as $committee)
                            <tr>
                                <td class="text-center">{{$committee->order}}</td>
                                <td class="text-center"><img src="{{$committee->getFirstMediaURL('committee','small')}}" alt="" width="32px"></td>
                                <td class="text-center">{{$committee->name}}</td>
                                <td class="text-center">{{count($committee->members)}}</td>
                                <td class="text-end">
                                    @can('committees_view')
                                    <button class="btn btn-square btn-primary w-1"><i class="fa fa-eye"></i></button>
                                    @endcan
                                    @can('committees_edit')
                                    <button class="btn btn-square btn-dernek-acik w-1" wire:click="openAddMemberModelFor({{$committee->id}})"><i class="fa fa-user-plus"></i></button>
                                    <button class="btn btn-square btn-warning w-1"><i class="fa fa-edit"></i></button>
                                    @endcan
                                    @can('committees_delete')
                                    <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{$committee->id}})" class="btn btn-square btn-danger w-1"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center" style="border-radius: 0px">İçerik bulunamadı.</div>
            @endif
        </div>
    </div>
    @can('committees_create')
        <!-- Düzenleme ve kullanıcı ekleme modalları başlangıcı-->
            <div wire:ignore.self class="modal modal-blur fade" id="modal-add-members" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Üye Ekleniyor: {{$editing_committee_name}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-selectgroup-boxes row mb-3">
                                    <div class="col-lg-6"><label class="form-selectgroup-item">
                                            <input type="radio" value="1" class="form-selectgroup-input" wire:model="is_registered">
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                          <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                          <span class="form-selectgroup-title strong mb-1">Mevcut Üye</span>
                                          <span class="d-block text-muted">Sistemdeki üyelerden seçim yapılır, tüm bilgiler otomatik olarak doldurulur.</span>
                                        </span>
                                      </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-6 mt-2 mt-lg-0">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" value="0" class="form-selectgroup-input" wire:model="is_registered">
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                <span class="me-3">
                                          <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                          <span class="form-selectgroup-title strong mb-1">Tanımsız Üye</span>
                                          <span class="d-block text-muted">Bilgiler tarafınızdan doldurulur. (Merkezi ve bölgesel kurullar için)</span>
                                        </span>
                                      </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if($is_registered)
                            <div class="row">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" wire:model="user">
                                        <option selected="" value="">Üye seçiniz...</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{ $user->name.' '.$user->surname  }}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect" class="ms-1">Üye Seçimi</label>
                                </div>
                            </div>
                            @endif
                            <div class="row mb-3">
                                <h4 class="ms-1">Kullanıcı Fotoğrafı</h4>
                                <div class="col-auto">
                                    <img src="{{$photo_url?$photo_url:url('img/default_committee_member.png')}}" alt="Varsayılan Kullanıcı Fotoğrafı" width="96px">
                                </div>
                                <div class="col-10">
                                        <span class="mb-2">Kullanacağınız fotoğrafın kare olması önerilir. Boyutlandırma otomatik olarak yapılacaktır.</span><br>
                                        <input type="file" class="form-control mt-3" wire:model="member_photo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="floating-input3" autocomplete="off" wire:model.lazy="name">
                                        <label for="floating-input3" class="ms-1">Ad</label>
                                        <div class="invalid-feedback">@error('name') {{$message}} @enderror</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('surname') is-invalid @enderror" id="floating-input3" autocomplete="off" wire:model.lazy="surname">
                                        <label for="floating-input3" class="ms-1">Soyad</label>
                                        <div class="invalid-feedback">@error('surname') {{$message}} @enderror</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="floating-input3" autocomplete="off" wire:model.lazy="order">
                                        <label for="floating-input3" class="ms-1">Sıra</label>
                                        <div class="invalid-feedback">@error('order') {{$message}} @enderror</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="ms-1">Kullanıcı Rolleri (Görevleri) <span class="text-danger">@error('added_roles') {{$message}} @enderror</span></h4>
                                <div class="col-6 col-md-9">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('role_name') is-invalid @enderror" id="floating-input3" autocomplete="off" wire:model.lazy="role_name">
                                        <label for="floating-input3" class="ms-1">Rol - Görev</label>
                                        <div class="invalid-feedback">@error('role_name') {{$message}} @enderror</div>
                                    </div>
                                </div>
                                <div class="col-4 col-md-2">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control @error('role_order') is-invalid @enderror" id="floating-input3" autocomplete="off" wire:model.lazy="role_order">
                                        <label for="floating-input3" class="ms-1">Sıra</label>
                                        <div class="invalid-feedback">@error('role_order') {{$message}} @enderror</div>
                                    </div>
                                </div>
                                <div class="col-2 col-lg-1">
                                    <button class="btn btn-square btn-success h-75" wire:click="attachRole()"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            @if(!empty($added_roles))
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="w-1 text-center">Sıra</th>
                                            <th>Rol - Görev</th>
                                            <th class="w-1"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(collect($added_roles)->sortBy('role_order') as $key => $added_role)
                                            <tr>
                                                <td class="text-center">{{$added_role['role_order']}}</td>
                                                <td>{{$added_role['role_name']}}</td>
                                                <td><button class="btn w-1 btn-square btn-danger" wire:click="detachRole({{$key}})"><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal" wire:click="resetAll()">Kapat</button>
                            <button type="button" class="btn btn-primary" wire:click="storeCommitteeMember()">Kaydet</button>
                        </div>
                    </div>
                </div>
            </div>
    @endcan
    @section('custom_scripts')
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script>
            window.addEventListener('openModelAddMember', event => {
                $('#modal-add-members').modal('show');
            })
            window.addEventListener('closeModelAddMember', event => {
                $('#modal-add-members').modal('hide');
            })
        </script>
        <script>
            window.addEventListener('show-delete-confirmation', event => {
                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Kurulu sildiğinizde üyeleriyle birlikte silinecektir. Silme işlemi geri alınamaz. İşleme devam etmek istediğinizden emin misiniz?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sil',
                    cancelButtonText: 'Vazgeç'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteConfirmed')
                    }
                })
            })

            window.addEventListener('committeeDeleted', event => {
                Swal.fire({
                    title: 'Başarılı!',
                    text: 'Kurul başarıyla silindi.',
                    icon: 'success',
                    confirmButtonText: 'Tamam'
                })
            })
        </script>
    @endsection
</div>
