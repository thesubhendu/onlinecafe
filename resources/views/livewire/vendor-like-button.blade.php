<div>
    <a href="#" wire:click.prevent="toggleLike">
        @if ($vendor->isFavorited())
            <i class="fa fa-coffee" style="background-color: #e28936; color:white"></i>
        @else
            <i class="fa fa-coffee"></i>
        @endif
    </a>
</div>
