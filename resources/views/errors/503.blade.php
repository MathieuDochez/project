@extends('errors::base_err')

@section('title', __('Service Unavailable'))
@section('subtitle', __('Oops... 503 Service Unavailable'))
@section('code', '503')
@section('message', __('Apologies, Combell Service has run into some issues and is unreachable.'))
