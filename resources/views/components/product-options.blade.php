@foreach (json_decode($product->pivot->options, true) as $key => $value )
    <ul>
        @foreach($value as $key => $val)
                <li>
                  {{$key}} :  {{$val}}
                </li>
        @endforeach
    </ul>
@endforeach
