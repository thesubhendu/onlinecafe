<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->required()
                    ->default(1),
                Forms\Components\TextInput::make('free_category')
                    ->numeric(),
                Forms\Components\TextInput::make('vendor_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_lastname')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mobile')
                    ->maxLength(255),
                Forms\Components\TextInput::make('stripe_account_id')
                    ->maxLength(100),
                Forms\Components\TextInput::make('shop_email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('shop_mobile')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('suburb')
                    ->maxLength(255),
                Forms\Components\TextInput::make('pc')
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('vendor_image')
                    ->image(),
                Forms\Components\TextInput::make('vendor_logo')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\Toggle::make('is_subscribed')
                    ->required(),
                Forms\Components\TextInput::make('abn')
                    ->maxLength(15),
                Forms\Components\TextInput::make('shop_name')
                    ->maxLength(60),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('opening_hours'),
                Forms\Components\TextInput::make('services'),
                Forms\Components\TextInput::make('max_stamps')
                    ->numeric(),
                Forms\Components\TextInput::make('get_free')
                    ->numeric(),
                Forms\Components\TextInput::make('lat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lng')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_rewarding_active')
                    ->required(),
                Forms\Components\DateTimePicker::make('charges_enabled_at'),
                Forms\Components\Toggle::make('is_taking_orders')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('owner_id')
                    ->numeric()
                    ->sortable(),
//                Tables\Columns\TextColumn::make('free_category')
//                    ->numeric()
//                    ->sortable(),
                Tables\Columns\TextColumn::make('vendor_name')
                    ->searchable(),
//                Tables\Columns\TextColumn::make('slug')
//                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_lastname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stripe_account_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shop_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shop_mobile')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_subscribed')
                    ->boolean(),
                Tables\Columns\TextColumn::make('abn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shop_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_stamps')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('get_free')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_rewarding_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('charges_enabled_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_taking_orders')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}
