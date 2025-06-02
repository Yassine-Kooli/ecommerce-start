<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use TomatoPHP\FilamentEcommerce\Models\Product;
use TomatoPHP\FilamentCms\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductCategoriesWidget extends ChartWidget
{
    protected static ?string $heading = 'Products by Category';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $categories = Category::where('for', 'products')
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->limit(8)
            ->get();

        $labels = [];
        $data = [];
        
        foreach ($categories as $category) {
            $categoryName = is_array($category->name) 
                ? ($category->name['en'] ?? 'Unknown Category')
                : $category->name;
            $labels[] = $categoryName;
            $data[] = $category->products_count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Products',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(236, 72, 153, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
