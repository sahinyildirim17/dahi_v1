@extends('errors::minimal')

@section('title','Sayfa Bulunamadı - '.config('settings.title'))
@section('code', 404)
@section('message',$exception->getMessage() ?: 'Sayfa Bulunamadı')
