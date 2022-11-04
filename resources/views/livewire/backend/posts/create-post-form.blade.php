<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-newspaper me-2"></i>İçerik Ekle</h3>
            @can('posts_create')
                <div class="card-actions">
                    <a href="{{route('posts.index')}}" class="btn btn-primary"><i class="fa fa-list me-1"></i>Listeye Dön</a>
                </div>
            @endcan
        </div>
    <div class="card-body row">
        <div class="col-12 col-lg-6">
            <div class="form-floating mb-3">
                <select class="form-select @error('post_type') is-invalid @enderror" wire:model="post_type" aria-label="Floating label select example">
                    <option selected="">Seçiniz...</option>
                    <option value="1">Haber</option>
                    <option value="2">Duyuru</option>
                </select>
                <label for="floatingSelect">İçerik Türü</label>
                <div class="invalid-feedback">@error('post_type') {{$message}} @enderror</div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="floating-input" autocomplete="off" wire:model.lazy="title">
                <label for="floating-input">İçerik Başlığı</label>
                <div class="invalid-feedback">@error('title') {{$message}} @enderror</div>

            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floating-input" autocomplete="off" wire:model.lazy="slug" disabled="disabled">
                <label for="floating-input">İçerik Adresi</label>
            </div>
            <div id="content_container" wire:ignore>
                <textarea wire:model.lazy="content" name="content" id="content" cols="30" rows="4" style="height: 400px"></textarea>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <div class="form-label"><strong>Etiketler</strong>
                    <div class="row mt-2">
                    <div class="col-10">
                        <input class="form-control" list="datalistOptions" placeholder="Yazmaya başlayın..." wire:model.lazy="new_tag"  wire:keydown.enter="addTag">
                        <datalist id="datalistOptions">
                            @foreach($all_tags as $tag)
                                <option>{{$tag->name}}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-dernek-acik w-100" wire:click="addTag"><i class="fa fa-plus me-1"></i>Ekle</button>
                    </div>
                    </div>
                    <div class="row p-2 pb-0" id="tags">
                        @foreach($added_tags as $added_tag)
                            <button class="btn btn-dernek btn-sm w-auto m-1" wire:click="removeTag('{{$added_tag}}')">{{$added_tag}} <i class="fa fa-times ms-1"></i></button>
                        @endforeach
                    </div>
            </div>
            <hr class="mt-0 mb-2">
            <div class="mb-3">
                <div class="form-label"><strong>İçerik Fotoğrafı</strong>
                    @if($thumb_updated)
                        <button href="" class="btn btn-sm btn-danger" wire:click="remove_existing_photo"><i class="fa fa-times me-1"></i>Kaldır</button>
                    @endif</div>
                <div class="loader-container text-center">
                    <div wire:loading wire:target="photo" class="spinner-border spinner-border-lg text-muted float-center mt-2 mb-3" role="status"></div>
                </div>
                @if(!empty($photo_preview_link))
                    <img src="{{$photo_preview_link}}" alt="" class="mb-3 mt-3" width="30%">
                @endif
                <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" wire:model="photo">
                <div class="invalid-feedback">@error('photo') {{$message}} @enderror</div>
            </div>
            <div class="pe-2 mb-3">
                <label class="row mb-2">
                    <span class="col text-end"><i class="fa fa-check me-1"></i> Bu içerik aktif olsun.</span>
                    <span class="col-auto">
                                            <label class="form-check form-check-single form-switch">
                                                <input class="form-check-input" type="checkbox" wire:model="is_active">
                                            </label>
                                        </span>
                </label>
                <label class="row">
                    <span class="col text-end"><i class="fa fa-star me-1"></i> Bu içerik anasayfada öne çıkarılsın.</span>
                    <span class="col-auto">
                                            <label class="form-check form-check-single form-switch">
                                                <input class="form-check-input" type="checkbox" wire:model="is_featured">
                                            </label>
                                        </span>
                </label>
            </div>
            @if($is_active)
                <div class="alert alert-success">
                    <span class="h4">Dikkat: içeriği aktifleştirdiniz.</span><br>
                    <span>Bu içeriği kaydettiğiniz anda sitede yayınlanacaktır. Taslak olarak kaydetmek ve düzenledikten sonra yayınlamak istiyorsanız aktiflik seçeneğini kapatabilirsiniz.</span>

                </div>
            @endif
            @if($is_featured && $photo==NULL)
            <div class="alert alert-warning">Fotoğraf eklemeden içeriği öne çıkarmanız durumunda anasayfada varsayılan görsel kullanılacaktır.</div>
            @endif

            <hr class="mb-2">

            <div class="form-label"><strong>İçerik Dosyaları</strong></div>
            <div class="alert">İhtiyaç duymanız halinde bu bölümden içeriğe dosya ekleyebilirsiniz.</div>
            <div class="row">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="filename" name="filename" autocomplete="off" wire:model.lazy="filename">
                        <label for="filename">Dosya Adı</label>
                    </div>
            </div>
            <div class="row mb-2">
                <div class="col-12" wire:loading wire:target="file">
                    <div class="progress mb-2">
                        <div class="progress-bar progress-bar-indeterminate bg-green"></div>
                    </div>
                </div>
                <div class="col-12" wire:loading wire:target="attachFile">
                    <div class="progress mb-2">
                        <div class="progress-bar progress-bar-indeterminate bg-green"></div>
                    </div>
                </div>
                <div class="col-10">
                    <input type="file" class="form-control @error('file') is-invalid @enderror" wire:model="file">
                    <div class="invalid-feedback mt-1 ms-1">@error('file') {{$message}} @enderror</div>
                    @if($file_updated)
                        <div class="text-success mt-1 ms-1">Dosya eklenmeye hazır.</div>
                    @endif
                </div>
                <div class="col-2">
                    <button class="btn btn-success btn-square w-100" wire:click="attachFile" @if(!$file_updated||is_null($filename)) disabled="" @endif><i class="fa fa-plus me-1"></i>Ekle</button>
                </div>
            </div>
            @if(!empty($attached_files))
                <div class="row pt-2 ps-2 pe-1">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Dosya Adı</th>
                            <th>Uzantısı</th>
                            <th>Boyutu</th>
                            <th class="w-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attached_files as $key => $attached_file)
                            <tr>
                                <td>{{$attached_file['filename']}}</td>
                                <td>{{$attached_file['extension']}}</td>
                                <td>{{$attached_file['file_size']}} MB</td>
                                <td><button class="btn btn-square btn-danger" wire:click="detachFile({{$key}})"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
        <div class="card-footer text-end">
            <button class="btn btn-muted">İptal</button>
            <button class="btn btn-success" wire:click="storePost" wire:loading.attr="disabled">
                <div class="spinner-border spinner-border-sm me-2" role="status" wire:loading wire:target="storePost">
                    <span class="sr-only">Loading...</span>
                </div>
                Kaydet
            </button>
        </div>
    </div>
</div>

@section('custom_scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
    <script>
        class MyUploadAdapter {
            // ...
            constructor( loader ) {
                // The file loader instance to use during the upload. It sounds scary but do not
                // worry — the loader will be passed into the adapter later on in this guide.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then( file => new Promise( ( resolve, reject ) => {
                        this._initRequest();
                        this._initListeners( resolve, reject, file );
                        this._sendRequest( file );
                    } ) );
            }

            // Aborts the upload process.
            abort() {
                if ( this.xhr ) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open( 'POST', '{{route('panel.posts.ckeditor_upload')}}', true );
                xhr.setRequestHeader('x-csrf-token','{{csrf_token()}}');
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners( resolve, reject, file ) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener( 'error', () => reject( genericErrorText ) );
                xhr.addEventListener( 'abort', () => reject() );
                xhr.addEventListener( 'load', () => {
                    const response = xhr.response;

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if ( !response || response.error ) {
                        return reject( response && response.error ? response.error.message : genericErrorText );
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve( {
                        default: response.url
                    } );
                } );

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if ( xhr.upload ) {
                    xhr.upload.addEventListener( 'progress', evt => {
                        if ( evt.lengthComputable ) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    } );
                }
            }

            // Prepares the data and sends the request.
            _sendRequest( file ) {
                // Prepare the form data.
                const data = new FormData();

                data.append( 'upload', file );
                data.append( 'post_id', '0' );

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send( data );
            }


            // ...
        }

        function SimpleUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter( loader );
            };
        }


        ClassicEditor
            .create(document.querySelector('#content'), {
                extraPlugins: [ SimpleUploadAdapterPlugin ]
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                @this.set('content', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
