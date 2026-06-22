<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Brand;
use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name')
                    ->required(),

                TextInput::make('slug')
                    ->required(),

                TextInput::make('sku')
                    ->required(),

                FileUpload::make('image')
                    ->image()
                    ->directory('products')
                    ->disk('public')
                    ->imageEditor(),

                Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->searchable(),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable(),

                TextInput::make('price')
                    ->numeric()
                    ->required(),

                TextInput::make('sale_price')
                    ->numeric(),

                TextInput::make('stock')
                    ->numeric()
                    ->default(0),

                TextInput::make('weight')
                    ->numeric()
                    ->default(0),

                Textarea::make('description')
                    ->columnSpanFull(),

                Toggle::make('featured'),

                Toggle::make('status')
                    ->default(true),

            ]);
    }
}
