<!-- TITLE -->
<div class="row mb-4">
    <div class="col-md-12 m-0 p-0 ">
        <div class="content-heading">
            <h3 class="title">Deals</h3>
        </div>
    </div>
</div>

<div class="row mb-4 ">
    @foreach ($deals as $deal)
        <div class="col-md-4 col-sm-12 text-center">
            @if($deal->image)
                <img src="{{asset($deal->image)}}" alt="">
            @else
                <img src="{{asset('/assets/images/donation.png')}}" alt="">
            @endif

            <h3>{{$deal->title}}</h3>
            <p>Expires at: {{$deal->expires_at->diffForHumans()}}</p>
            <a href="{{route('checkout.index',['deal'=> $deal->id])}}" class="btn btn-primary">Add Deal</a>
        </div>
    @endforeach
</div>
