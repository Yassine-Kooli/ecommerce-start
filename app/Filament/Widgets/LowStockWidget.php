<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use TomatoPHP\FilamentEcommerce\Models\Product;

class LowStockWidget extends BaseWidget
{
    protected static ?string $heading = 'Low Stock Products';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('is_in_stock', false)
                    ->orWhere('has_stock_alert', true)
                    ->orderBy('is_in_stock', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Product Name')
                    ->formatStateUsing(fn ($state) => is_array($state) ? ($state['en'] ?? 'Unknown') : $state)
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('min_stock_alert')
                    ->label('Min Stock Alert')
                    ->sortable()
                    ->badge()
                    ->color('warning')
                    ->default('N/A'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_in_stock')
                    ->label('In Stock'),
            ])
            ->actions([
                Tables\Actions\Action::make('restock')
                    ->icon('heroicon-m-plus')
                    ->color('success')
                    ->url(fn (Product $record): string => route('filament.admin.resources.products.edit', $record)),
            ]);
    }
}
