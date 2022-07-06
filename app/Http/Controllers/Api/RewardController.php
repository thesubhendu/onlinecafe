<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RewardCollection;
use App\Repositories\RewardRepository;

class RewardController extends Controller
{
    function __construct(
        public RewardRepository $repository
    )
    {

    }

    public function index()
    {
        $user = auth()->user();
        return new RewardCollection($this->repository->rewards($user));
    }
}
