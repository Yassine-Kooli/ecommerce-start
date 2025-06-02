<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CustomersDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static string $view = 'filament.pages.customers-dashboard';
    
    protected static ?string $navigationLabel = 'Customers Dashboard';
    
    protected static ?string $title = 'Customers Dashboard';
    
    protected static ?int $navigationSort = 4;
    
    protected static ?string $navigationGroup = 'Dashboards';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\CustomerStatsWidget::class,
            \App\Filament\Widgets\CustomerGrowthWidget::class,
            \App\Filament\Widgets\TopCustomersWidget::class,
            \App\Filament\Widgets\CustomerLocationWidget::class,
        ];
    }
}
