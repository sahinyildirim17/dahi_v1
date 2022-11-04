@extends('layouts.backend.app')

@section('custom_styles')
@section('title', "Kurul Yönetimi")
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 @can('committees_create') col-lg-8 @else col-lg-12 @endcan">
                    @livewire('backend.committees.index')
                </div>
                @can('committees_create')
                <div class="col-12 col-lg-4">
                    @livewire('backend.committees.create-committee-form')
                </div>
                @endcan
            </div>

        </div>
    </div>
@endsection
@section('custom_scripts')

@endsection
