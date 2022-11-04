@extends('errors::minimal')

@section('title','403 - '.config('settings.title'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Yasaklı'))
