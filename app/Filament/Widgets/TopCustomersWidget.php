<?php

namespace App\Filament\Widgets;

use App\Models\Account;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopCustomersWidget extends BaseWidget
{
    protected static ?string $heading = 'Top Customers';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Account::query()
                    ->withSum('orders', 'total')
                    ->withCount('orders')
                    ->orderBy('orders_sum_total', 'desc')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('orders_count')
                    ->label('Total Orders')
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('orders_sum_total')
                    ->label('Total Spent')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Member Since')
                    ->date()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (Account $record): string => route('filament.admin.resources.accounts.view', $record))
                    ->icon('heroicon-m-eye'),
            ]);
    }
}
