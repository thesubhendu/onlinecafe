<!-- TITLE -->
@if($deals)
<div class="row mb-4">
    <div class="col-md-12 m-0 p-0 ">
        <div class="content-heading">
            <h3 class="title">Deals</h3>
        </div>
    </div>
</div>
@endif

<div class="row deals-row ">
    @foreach ($deals as $deal)
    <div class="col-md-4 col-sm-12 text-center icon-box">
        <div class="icon-imaged">
            @if($deal->image)
            <img width="300px"  src="{{asset("storage/".$deal->image)}}" alt="">
            @else
            <img src="{{asset('/assets/images/donation.png')}}" alt="">
            @endif
        </div>

        <h4>{{$deal->title}}</h4>
        <div class="icon-title">
            <p>Expires at: {{$deal->expires_at->diffForHumans()}}</p>
        </div>
        <a href="{{route('checkout.index',['deal'=> $deal->id])}}" class="btn btn-primary action-btn">Add Deal</a>
    </div>
</div>
@endforeach
