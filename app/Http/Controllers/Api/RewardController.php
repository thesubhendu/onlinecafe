<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\RewardCollection;
use App\Models\Card;
use App\Repositories\RewardRepository;
use App\Services\LoyaltyClaimService;
use Illuminate\Http\JsonResponse;

class RewardController extends ApiBaseController
{
    public function __construct(
        public RewardRepository $repository,
        public LoyaltyClaimService $loyaltyClaimService
    ) {

    }

    public function index()
    {
        $user = auth()->user();
        return new RewardCollection($this->repository->rewards($user));
    }

    public function applyManualClaim(Card $card): JsonResponse
    {
        return $this->sendResponse(
            $this->loyaltyClaimService->applyManualClaim($card),
            'Reward order created'
        );
    }



}
