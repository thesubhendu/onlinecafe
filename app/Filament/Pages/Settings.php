<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\TakingOrderStatus;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use Filament\Actions\Action;


class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    public $vendor;

    public static function shouldRegisterNavigation(): bool
    {
        return \Gate::denies('admin');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TakingOrderStatus::make([
                'vendor'=> $this->vendor
            ])
        ];
    }


    public function mount(): void
    {
        $this->vendor = auth()->user()->shop;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Toggle Taking Orders')
                ->visible(!empty($this->vendor))
                ->fillForm(fn(): array => [
                    'is_taking_orders' => $this->vendor->is_taking_orders
                ])
                ->form([
                    Toggle::make('is_taking_orders')
                ])
                ->action(function (array $data): void {
                    $this->vendor->update(['is_taking_orders' => $data['is_taking_orders']]);
                    $this->vendor = $this->vendor->fresh();
                    $this->dispatch('order-status-changed');
                }),

        ];
    }
}
