<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Select::make('vendor_id')
                    ->label('Vendor')
                    ->relationship(name: 'vendor', titleAttribute: 'vendor_name')
                    ->required()
                    ->default(auth()->user()?->shop?->id)
                    ->disabled(!auth()->user()->isAdmin())
                ,
                Forms\Components\Select::make('category_id')
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(255),


                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Grid::make('Toggles')
                            ->columnSpan(1)
                            ->schema([

                                Forms\Components\Toggle::make('is_active')
                                    ->required(),
                                Forms\Components\Toggle::make('is_stamp')
                                    ->required(),

                                Forms\Components\Toggle::make('is_all_sizes_available')
                                    ->required(),
                            ]),
                        Forms\Components\FileUpload::make('product_image')
                            ->columnSpan(1)
                            ->directory('product-images')
                            ->image(),

                    ]),


                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$'),


                        Forms\Components\Repeater::make('productPrices')
                            ->label('Product Prices for Size')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('size')->options(config('sizes')),
                                Forms\Components\TextInput::make('price')
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vendor_id')
                    ->label('Vendor')
                    ->visible(auth()->user()->isAdmin())
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_stamp')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_all_sizes_available')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
