<div>
    <a href="#" wire:click.prevent="toggleLike">
        @if ($vendor->isFavorited())
            <i class="ti-heart" style="background-color: green; color:white"></i>
        @else
            <i class="ti-heart"></i>
        @endif
    </a>
</div>
