<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\Order;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class DashboardScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Dashboard';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $vendor = auth()->user()->shop ?? new Vendor();

        if (Gate::allows('admin')) {
            $salesToday = Order::query()->whereDate('created_at', Carbon::today())->get()->sum('order_total');
            $totalSales = Order::query()->sum('order_total');
            $totalOrders = Order::query()->count() ?? 0;
            $customers = Order::query()->groupBy('user_id')->count();
        } else {
            $salesToday = $vendor->orders()->whereDate('created_at', Carbon::today())->get()->sum('order_total');
            $totalSales = $vendor->orders->sum('order_total');
            $totalOrders = $vendor->orders->count();
            $customers = $vendor->orders()->groupBy('user_id')->count();
        }

        return [
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'salesToday' => $salesToday,
            'customers' => $customers,
            'likes' => $vendor->favoritesCount ?? 0
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
//            Link::make('Website')
//                ->href('http://orchid.software')
//                ->icon('globe-alt'),


        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::view('admin.dashboard'),
        ];
    }
}
