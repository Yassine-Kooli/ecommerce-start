<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Widgets\StatsOverviewWidget;

class SalesDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    
    protected static string $view = 'filament.pages.sales-dashboard';
    
    protected static ?string $navigationLabel = 'Sales Dashboard';
    
    protected static ?string $title = 'Sales Dashboard';
    
    protected static ?int $navigationSort = 2;
    
    protected static ?string $navigationGroup = 'Dashboards';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\SalesStatsWidget::class,
            \App\Filament\Widgets\SalesChartWidget::class,
            \App\Filament\Widgets\RecentOrdersWidget::class,
            \App\Filament\Widgets\TopProductsWidget::class,
        ];
    }
}
