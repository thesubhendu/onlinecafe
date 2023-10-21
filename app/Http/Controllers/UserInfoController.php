<?php

namespace App\Http\Controllers;

class UserInfoController extends Controller
{
    public function __invoke()
    {
        if (auth()->check()) {
            return ['user' => auth()->user()];
        }
        return ['user' => ''];
    }
}
