@extends('errors::base_err')

@section('title', __('Gateway Timeout'))
@section('subtitle', __('Oops... 504 Gateway Timeout'))
@section('code', '504')
@section('message', __('Apologies, the site is down temporarily and will return soon.'))
