@foreach (json_decode($product->pivot->options, true) as $key => $value )
    {{$key}} => {{json_encode($value)}} <br>
@endforeach
