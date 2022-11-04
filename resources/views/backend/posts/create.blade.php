@extends('layouts.backend.app')

@section('custom_styles')
    <style>
        .ck-editor__editable {
            min-height: 300px;
        }
    </style>
@endsection
@section('title', "İçerik Ekle")
@section('content')
    <div class="page-body">
        <div class="container-xl">
                    @livewire('backend.posts.create-post-form')
            </div>
    </div>
@endsection

