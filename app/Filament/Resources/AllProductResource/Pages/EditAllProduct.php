<?php

namespace App\Filament\Resources\AllProductResource\Pages;

use App\Filament\Resources\AllProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAllProduct extends EditRecord
{
    protected static string $resource = AllProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
