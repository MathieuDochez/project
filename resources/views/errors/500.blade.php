@extends('errors::base_err')

@section('title', __('Server Error'))
@section('subtitle', __('Oops... 500 Server Error'))
@section('code', '500')
@section('message', __('Apologies, The page you are looking has run into a server error.'))
