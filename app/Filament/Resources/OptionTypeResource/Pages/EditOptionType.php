<?php

namespace App\Filament\Resources\OptionTypeResource\Pages;

use App\Filament\Resources\OptionTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOptionType extends EditRecord
{
    protected static string $resource = OptionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
