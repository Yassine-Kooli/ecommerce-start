<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use TomatoPHP\FilamentEcommerce\Models\OrderItem;

class TopProductsWidget extends ChartWidget
{
    protected static ?string $heading = 'Top Selling Products';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(qty) as total_sold'))
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->with('product')
            ->get();

        $labels = [];
        $data = [];

        foreach ($topProducts as $item) {
            if ($item->product) {
                $productName = is_array($item->product->name)
                    ? ($item->product->name['en'] ?? 'Unknown Product')
                    : $item->product->name;
                $labels[] = $productName;
                $data[] = $item->total_sold;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Units Sold',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
