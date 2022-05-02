<section class="shop-vendors">
    <div class="container">
        <h3>Favourite Partners</h3>
        <div class="row">
            @foreach($vendors as $vendor)

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <x-vendor-card :vendor="$vendor"></x-vendor-card>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
