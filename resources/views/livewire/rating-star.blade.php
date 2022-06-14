<div>
    {{-- Be like water. --}}
    @for($i=0; $i < round($vendor->rating()); $i++)
        <i wire:click="setRating({{$i+1}})" class="fa fa-coffee selected"></i>
    @endfor
    @for($i=round($vendor->rating()); $i< 5; $i++)
            <i wire:click="setRating({{$i+1}})" class="fa fa-coffee"></i>
    @endfor
    <span style="color: #a9a9a9"><b>{{$vendor->rating()}}</b></span>
</div>
