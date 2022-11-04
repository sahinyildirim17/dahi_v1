@extends('layouts.backend.app')

@section('custom_styles')
@section('title', "İçerik Yönetimi")
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">

            @livewire('backend.posts.index')

        </div>
    </div>
@endsection
@section('custom_scripts')

@endsection
