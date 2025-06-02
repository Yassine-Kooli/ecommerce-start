<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use TomatoPHP\FilamentEcommerce\Models\Product;
use TomatoPHP\FilamentCms\Models\Category;

class ProductStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_activated', true)->count();
        $outOfStock = Product::where('is_in_stock', false)->count();
        $totalCategories = Category::where('for', 'products')->count();
        
        return [
            Stat::make('Total Products', number_format($totalProducts))
                ->description('All products in catalog')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),
                
            Stat::make('Active Products', number_format($activeProducts))
                ->description('Currently available')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
                
            Stat::make('Out of Stock', number_format($outOfStock))
                ->description('Need restocking')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
                
            Stat::make('Categories', number_format($totalCategories))
                ->description('Product categories')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
        ];
    }
}
