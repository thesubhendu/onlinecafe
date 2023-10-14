<?php

namespace App\Filament\Resources\VendorProductOptionResource\Pages;

use App\Filament\Resources\VendorProductOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendorProductOptions extends ListRecords
{
    protected static string $resource = VendorProductOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
