<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use TomatoPHP\FilamentEcommerce\Models\Product;
use TomatoPHP\FilamentEcommerce\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ProductPerformanceWidget extends ChartWidget
{
    protected static ?string $heading = 'Product Performance (Last 30 Days)';
    
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $data = [];
        $labels = [];
        
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('M j');
            
            $sales = OrderItem::whereDate('created_at', $date)
                ->sum('qty');
                
            $data[] = $sales;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Units Sold',
                    'data' => $data,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'borderColor' => 'rgb(16, 185, 129)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
