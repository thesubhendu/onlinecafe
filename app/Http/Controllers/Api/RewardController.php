<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ClaimedOrderResource;
use App\Http\Resources\RewardCollection;
use App\Models\Card;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Repositories\RewardRepository;
use App\Services\RewardClaimService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RewardController extends ApiBaseController
{
    public function __construct(
        public RewardRepository $repository,
        public RewardClaimService $rewardClaimService
    ) {

    }

    public function index(): RewardCollection
    {
        $user = auth()->user();
        return new RewardCollection($this->repository->rewards($user));
    }

    public function getClaimedOrder(): JsonResponse
    {
        return $this->sendResponse(
            new ClaimedOrderResource($this->rewardClaimService->getClaimedOrder(auth()->id()))
        );
    }

    public function claim(Card $card): JsonResponse
    {
        return $this->sendResponse(
            new ClaimedOrderResource($this->rewardClaimService->applyManualClaim($card)),
            'Reward order created'
        );
    }

    public function addProduct(Request $request, Order $order): JsonResponse
    {
        $request->validate([
            'product_id' => 'required',
            'vendor_id'  => 'required',
            'options'    => 'required'
        ]);

        if ($this->rewardClaimService->remainingClaimProductCount($order)) {
            return $this->sendResponse(
                new ClaimedOrderResource($this->rewardClaimService->addClaimProductOnCart($order, $request->all())),
                "Product add to cart"
            );
        }

        return $this->sendError(
            "No remaining reward claim products", 500
        );
    }

    public function removeProduct(OrderProduct $orderProduct): JsonResponse
    {
        return $this->sendResponse(
            new ClaimedOrderResource($this->rewardClaimService->remove($orderProduct)),
            "Product removed from cart"
        );
    }

}
