@extends('errors::minimal')

@section('title','Sayfa Bulunamad─▒ - '.config('settings.title'))
@section('code', 404)
@section('message',$exception->getMessage() ?: 'Sayfa Bulunamad─▒')
