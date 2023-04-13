<?php

namespace App\Orchid\Screens;

use App\Models\Deal;
use App\Orchid\Layouts\DealListLayout;
use Illuminate\Support\Facades\Gate;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class DealListScreen extends Screen
{

    public $name = 'Deals';

    public function query(): array
    {
        if (Gate::allows('admin')) {
            $deals = Deal::query()->filters()->latest()->paginate(50);
        } else {
            $deals = Deal::query()
                ->where('vendor_id', auth()->user()->shop->id)
                ->filters()->latest()->paginate(50);
        }
        return [
            'deals' => $deals,
        ];
    }


    public function commandBar(): array
    {
        return [
            Link::make('Create new Deal')
                ->icon('pencil')
                ->route('platform.deal.edit'),
        ];
    }


    public function layout(): array
    {
        return [
            DealListLayout::class
        ];
    }


    public function addProduct($vendor, $deal)
    {
        session(['deal-'.$vendor => $deal]);
        return redirect()->route('vendor.show', ['vendor'=> $vendor,'deal'=>$deal]);
    }
}