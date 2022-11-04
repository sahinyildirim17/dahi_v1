@extends('errors::minimal')

@section('title','Yetkisiz Erişim - '.config('settings.title'))
@section('code', '401')
@section('message', __($exception->getMessage() ?: 'Yetkisiz Erişim'))
