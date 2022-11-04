<div>
    <div class="row mb-lg-2">
        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <i class="fa fa-newspaper"></i>
                        </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{count($posts->where('post_type','=',1)->where('is_active','=',1))}}
                            </div>
                            <div class="text-muted">
                                Aktif Haber
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <i class="fa fa-bullhorn"></i>
                        </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{count($posts->where('post_type','=',2)->where('is_active','=',1))}}
                            </div>
                            <div class="text-muted">
                                Aktif Duyuru
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <span class="bg-dernek text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <i class="fa fa-calendar"></i>
                        </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                Son İçerik
                            </div>
                            <div class="text-muted">
                                {{ $last_post_diff }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 mb-2 mb-lg-0">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <span class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <i class="fa fa-chart-pie"></i>
                        </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                Görüntülenme
                            </div>
                            <div class="text-muted">
                                Toplam: {{$posts->sum('counter')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-newspaper me-2"></i>İçerik Yönetimi</h3>
            @can('posts_create')
            <div class="card-actions">
                <a href="{{route('posts.create')}}" class="btn btn-success"><i class="fa fa-plus me-1"></i>Ekle</a>
            </div>
            @endcan
        </div>
        <div class="card-body p-0">
            <div id="filtreler" class="row p-2">
                <div class="col-12 col-lg-6">

                </div>
                <div class="col-12 col-lg-2 mb-2 mb-lg-0">
                    <input type="text" class="form-control" name="filter_title" placeholder="Ara..." wire:model="filter_title" wire:keyup.debounce="filter">
                </div>
                <div class="col-12 col-lg-2 mb-2 mb-lg-0">
                    <select class="form-select" wire:model="filter_is_active" wire:change="filter">
                        <option value="">Aktif ve Pasif</option>
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                    </select>
                </div>
                <div class="col-12 col-lg-2 mb-2 mb-lg-0" wire:model="filter_post_type" wire:change="filter">
                    <select class="form-select">
                        <option value="">Tümü...</option>
                        <option value="1">Haberler</option>
                        <option value="2">Duyurular</option>
                    </select>
                </div>
            </div>
            @if(count($posts)>0)
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th class="w-1 text-center">TÜR</th>
                        <th>BAŞLIK</th>
                        <th class="text-center">OKUNMA</th>
                        <th class="text-center">DURUM</th>
                        <th class="text-center">ÖNE ÇIKARMA</th>
                        <th class="text-center">EKLENME TARİHİ</th>
                        <th class="text-center">DÜZENLENME TARİHİ</th>
                        <th class="w-1 text-center">İŞLEMLER</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                @if($post->post_type==1)
                                <button type="button" class="btn border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Haber">
                                    <i class="fa fa-newspaper"></i>
                                </button>
                                @elseif($post->post_type=2)
                                    <button type="button" class="btn border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Duyuru">
                                        <i class="fa fa-bullhorn"></i>
                                    </button>
                                @endif
                            </td>
                            <td>
                                {{$post->title}}
                                @if(count($post->getMedia('attached')) > 0)
                                    <small class="text-muted"> - {{count($post->getMedia('attached'))}}<i class="fa fa-paperclip ms-1"></i></small>
                                @endif
                            </td>
                            <td class="text-center">{{$post->counter}}</td>
                            <td class="text-center">
                                @if($post->is_active==1) <span class="badge bg-success me-1"></span> Aktif @else <span class="badge bg-danger me-1"></span> Pasif @endif
                            </td>
                            <td class="text-center">
                                @if($post->is_featured==1) <span class="badge bg-success me-1"></span> Aktif @else <span class="badge bg-danger me-1"></span> Pasif @endif
                            </td>
                            <td class="text-center">
                                {{\Carbon\Carbon::parse($post['created_at'])->format('d.m.Y - H:i')}}
                            </td>
                            <td class="text-center">
                                @if($post->updated_at!=NULL)
                                    {{\Carbon\Carbon::parse($post['updated_at'])->format('d.m.Y - H:i')}}
                                @else
                                -
                                @endif

                            </td>
                            <td class="text-end">
                                <button class="btn btn-square btn-primary pe-2 ps-2"><i class="fa fa-eye"></i></button>
                                @can('posts_edit')
                                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-square btn-warning pe-2 ps-2"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('posts_delete')
                                <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{$post->id}})" class="btn btn-square btn-danger pe-2 ps-2"><i class="fa fa-trash"></i></a>
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
        <div class="card-footer pb-0 justify-content-center align-content-center">
            <div class="pages text-center">

            </div>

        </div>
    </div>
</div>
@section('custom_scripts')
    <script>
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Silme işlemi geri alınamaz. İçeriği silmek istediğinizden emin misiniz?",
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

        window.addEventListener('postDeleted', event => {
            Swal.fire({
                title: 'Başarılı!',
                text: 'İçerik başarıyla silindi.',
                icon: 'success',
                confirmButtonText: 'Tamam'
            })
        })
    </script>
@endsection
