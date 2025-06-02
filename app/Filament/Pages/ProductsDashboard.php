<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ProductsDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    
    protected static string $view = 'filament.pages.products-dashboard';
    
    protected static ?string $navigationLabel = 'Products Dashboard';
    
    protected static ?string $title = 'Products Dashboard';
    
    protected static ?int $navigationSort = 3;
    
    protected static ?string $navigationGroup = 'Dashboards';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\ProductStatsWidget::class,
            \App\Filament\Widgets\ProductCategoriesWidget::class,
            \App\Filament\Widgets\LowStockWidget::class,
            \App\Filament\Widgets\ProductPerformanceWidget::class,
        ];
    }
}
