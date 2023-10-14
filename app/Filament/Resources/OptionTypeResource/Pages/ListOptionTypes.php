<?php

namespace App\Filament\Resources\OptionTypeResource\Pages;

use App\Filament\Resources\OptionTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptionTypes extends ListRecords
{
    protected static string $resource = OptionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
