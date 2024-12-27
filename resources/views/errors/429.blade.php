@extends('errors::base_err')

@section('title', __('Too Many Requests'))
@section('subtitle', __('Oops... 429 Too Many Requests'))
@section('code', '419')
@section('message', __('Apologies, you\'ve submitted too many requests to the server.'))
