@extends('layout.account')

@section('account')
<div class="card">
    <div class="card-header">{{ __('Update Card') }}</div>

    <div class="card-body">
        <x:card-form :action="route('account.subscriptions.card')">
            <button id="card-button" class="w-100 btn btn-primary btn-lg mt-4" type="submit" data-secret="{{ $intent->client_secret }}">
                Update
            </button>
        </x:card-form>
    </div>
</div>
@endsection
