<main role="main" class="my-coffees">
    <!-- <div class="container">
        <div id="card-showcase" class="">
            <div class="showcase-content">
                <h3 class="">Pay it Forward.</h3>
                <p class="">Lorem ipsum dolor sit amet.</p>
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-outline-success">Learn More</a>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container">
        <!-- TITLE -->
        <div class="row mb-4">
            <div class="col-md-12 m-0 p-0 ">
                <div class="content-heading">
                    <h3 class="title">My loyalty</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($cards as $card)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-logo card-header">
                        <div class="row">
                            <div class="col-md-7">
                                @if($card->card_logo)
                                    <div class="vendor-logo">
                                        <img src="{{asset('storage/img/'.$card->card_logo)}}">
                                    </div>
                                @endif
                                <div class="vendor-title">
                                    <h4>{{$card->vendor->vendor_name}}</h4>
                                    <p>Buy {{$card->vendor->max_stamps}} coffees get 1 free</p>
                                </div>
                            </div>
                            <div class="col text-right">
                                @if($card->is_max_stamped)
                                    <button type="button" class="btn btn-success btn-small" data-bs-toggle="modal"
                                            data-bs-target="#myModal">Pay Forward
                                    </button>
                                    <a href="{{route('checkout.index',['claim_loyalty_card'=> $card->id])}}" class="btn btn-primary action-btn">Claim</a>
                                @endif
                                <a href="{{route('vendor.products', $card->vendor_id )}}"
                                   class="btn btn-success btn-small">Order</a>

                                <!-- The Modal -->
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Pay Forward Form</h4>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                            </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <livewire:pay-forward-form />
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-1 g-4 justify-content-between">
                            <div class="col">
                                <div class="d-flex">
                                    <div>
                                        @foreach ($card->stamps as $stamp)
                                        <img src="{{asset('storage/img/stamp48x48.png')}}" width="48" height="48" alt="stamp">
                                        @endforeach

                                        @for ($i = 0; $i < ($card->vendor->max_stamps - $card->stamps->count()); $i++)
                                            <img src="{{asset('storage/img/nostamp48x48.png')}}" width="48" height="48" alt="nostamp">
                                            @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{$card->updated_at->diffForHumans()}}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</main><!-- /.container -->
