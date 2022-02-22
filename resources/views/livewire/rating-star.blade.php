<div>
    {{-- Be like water. --}}

    @for($i=0; $i < round($vendor->rating()); $i++)
        <i wire:click="setRating({{$i+1}})" class="fa fa-coffee selected"></i>
    @endfor
    @for($i=0; $i< 5 - round($vendor->rating()); $i++)
        <i wire:click="setRating({{5-$i}})" class="fa fa-coffee"></i>
    @endfor
    <span><b>{{$vendor->rating()}}</b></span>
</div>
