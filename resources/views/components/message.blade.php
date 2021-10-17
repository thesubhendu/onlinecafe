@php
    $sessionKey = 'message';
    $class = 'alert-success';

    if (!empty($type) && $type=='error') {
      $sessionKey = 'error';
      $class = 'alert-danger';
   }
@endphp

@if(session($sessionKey))
    <div class="alert {{$class}}">
        {{ session($sessionKey)  }}
    </div>
@endif
