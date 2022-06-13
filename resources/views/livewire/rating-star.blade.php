<div>
    {{-- Be like water. --}}

    @for($i=0; $i < round($vendor->rating()); $i++)
        <i wire:click="setRating({{$i+1}})" class="fa fa-coffee selected"></i>
    @endfor
    @for($i=round($vendor->rating()); $i< 5; $i++)
            <i wire:click="setRating({{$i+1}})" class="fa fa-coffee"></i>
    @endfor
    <span><b>{{$vendor->rating()}}</b></span>
</div>
