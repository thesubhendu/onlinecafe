<?php


class UpdateGeolocation
{
    public function handle($request, $next)
    {
        $request->session()->regenerate();

        $this->limiter->clear($request);

        return $next($request);
    }

}
