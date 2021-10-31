<x-app-layout>
    <main role="main" class="container py-4 mb-5 border-0">
        <div class="card mb-3 d-flex" style="max-width:1080px;">
            <div class="row g-0">
                <div class="col-sm-4">
                    <img src="/storage/img/nostamp.png" class="img-fluid p-0" alt="..." height="100" width="100">
                </div>
                <div class="col-sm-8">
                    <div class="card-body">
                        <h5 class="card-title text-success">Featured</h5>
                        <p class="card-text text-muted">{{$featured}}</p>
            </div>
          </div>
        </div>
      </div>
    <hr>
        <div class="mx-auto">
            @foreach ($vendorproducts as $product)
                {{-- @dd($vendorproducts); --}}
                <div class="card mt-4">
                    <div class="row no-gutters">
                        <div class="product-info card-body d-flex">
                            <div class="flex-fill">
                                <img src="{{asset('storage/img/nostamp.png')}}" class="card-product-img" alt="...">
                            </div>
                            <div class="col">
                                <p class="card-text">{{ $product->name}}</p>
                            </div>
                            <div class="col d-none d-md-block flex-fill">
                                <p class="card-text">{{ $product->description}}</p>
                            </div>
                            <div class="col">
                                <p class="card-text">${{ $product->price}}</p>
                            </div>
                            <div class="col float-sm-right">
                                {{-- <form action="{{ route('orders.create', $product) }}" method="get"> {{ route('cart.store') }} --}}
                                {{-- @csrf --}}
                                <input type="hidden" name="id" value="{{ $product->id}}">
                                <input type="hidden" name="name" value="{{ $product->name}}">
                                <input type="hidden" name="price" value="{{ $product->price}}">
                                <a href="{{ route('orders.create', $product->id) }}" name="order_submit"
                                   class="btn btn-success">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        <path fill-rule="evenodd"
                                              d="M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                </a>
                                {{-- <button class="btn btn-dark mt-2" type=submit>Add</button>
                            </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
    </main><!-- /.container -->
</x-app-layout>
