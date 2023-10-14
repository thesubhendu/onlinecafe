<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use Filament\Actions\Action;


class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    public $vendor;

    public function mount(): void
    {
        $this->vendor = auth()->user()->shop;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Toggle Taking Orders')
                ->fillForm(fn(): array => [
                    'is_taking_orders' => $this->vendor->is_taking_orders
                ])
                ->form([
                    Toggle::make('is_taking_orders')
                ])
                ->action(function (array $data): void {
                    $this->vendor->update(['is_taking_orders' => $data['is_taking_orders']]);
                }),

        ];
    }
}
