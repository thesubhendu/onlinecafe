<?php

namespace App\Filament\Resources\VendorProductOptionResource\Pages;

use App\Filament\Resources\VendorProductOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendorProductOption extends EditRecord
{
    protected static string $resource = VendorProductOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
