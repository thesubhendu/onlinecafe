@extends('layout.account')

@section('account')
<div class="card">
    <div class="card-header">{{ __('Cancel') }}</div>

    <div class="card-body">
        <form action="{{ route('account.subscriptions.cancel') }}" method="post">
            @csrf

            <button type="submit" class="btn btn-primary">Cancel</button>
        </form>
    </div>
</div>
@endsection
