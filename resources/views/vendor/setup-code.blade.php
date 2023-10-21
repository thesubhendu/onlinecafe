<x-mail::message>
# Congratulations! You have received code to claim your business

    You can now claim your business by clicking link below

<x-mail::button :url="$link">
Claim Business
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
