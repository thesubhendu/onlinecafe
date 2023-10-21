<?php

namespace App\Filament\Resources\VendorResource\Pages;

use App\Filament\Resources\VendorResource;
use App\Mail\VendorSetupCodeMail;
use App\Models\Vendor;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditVendor extends EditRecord
{
    protected static string $resource = VendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('sendSetupCode')
                ->form([
                    TextInput::make('mailAddress')->email()->required(),
                ])
                ->action(function (Vendor $vendor, array $data) {
                    Mail::to($data['mailAddress'])
                        ->send(new VendorSetupCodeMail($vendor));

                    Notification::make()
                        ->title('Email send successfully')
                        ->success()
                        ->send();
                })
        ];
    }
}
