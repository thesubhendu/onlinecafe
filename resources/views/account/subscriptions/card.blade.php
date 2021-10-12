@extends('layouts.account')

@section('account')
<div class="card">
    <div class="card-header">{{ __('Update Card') }}</div>

    <div class="card-body">
        <x:card-form :action="route('account.subscriptions.card')">
            <button id="card-button" class="w-100 btn btn-primary btn-lg" type="submit" data-secret="{{ $intent->client_secret }}">
                Update
            </button>
        </x:card-form>
    </div>
</div>
@endsection