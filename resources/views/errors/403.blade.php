@extends('errors::base_err')

@if(auth()->user() && !auth()->user()->active)
    @section('content')
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-4 p-4">
            <p class="text-gray-700 mb-4">Your account is currently inactive. We are in the process of activating
                it.</p>
            <p class="text-gray-700 mb-4">An email will be sent to {{ auth()->user()->email }} once your account has
                been activated.</p>
            <p class="text-gray-700">Thank you for your patience.</p>
        </div>
    @endsection

@else
    @section('title', __('Permission Denied'))
    @section('subtitle', __('Oops... 403 Permission Denied'))
    @section('code', '403')
    @section('message', __('Apologies, you don\'t have the necessary permissions to access this page.'))
@endif
