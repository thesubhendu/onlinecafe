<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionTypeResource\Pages;
use App\Filament\Resources\OptionTypeResource\RelationManagers;
use App\Models\OptionType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OptionTypeResource extends Resource
{
    protected static ?string $model = OptionType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return "Product Settings";
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('order_no')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_multiselect')
                    ->required(),
                Forms\Components\Select::make('productCategories')
                    ->multiple()
                    ->relationship(name:'productCategories',titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(20)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_no')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_multiselect')
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
            'index' => Pages\ListOptionTypes::route('/'),
            'create' => Pages\CreateOptionType::route('/create'),
            'edit' => Pages\EditOptionType::route('/{record}/edit'),
        ];
    }
}
