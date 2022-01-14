<div>
    <a href="#" wire:click.prevent="toggleLike">
        @if ($vendor->isFavorited())
            <i class="fa fa-coffee liked" style="background-color: #e28936; color:white"></i>
        @else
            <i class="fa fa-coffee normal"></i>
        @endif
    </a>
</div>
