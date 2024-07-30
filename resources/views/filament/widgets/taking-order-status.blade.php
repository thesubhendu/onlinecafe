<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <h3>{{$vendor->is_taking_orders ?"Yes":"No"}}  orders {{$vendor->name}} </h3>
    </x-filament::section>
</x-filament-widgets::widget>
