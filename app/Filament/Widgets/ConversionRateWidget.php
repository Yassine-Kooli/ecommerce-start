<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use TomatoPHP\FilamentEcommerce\Models\Order;

class ConversionRateWidget extends ChartWidget
{
    protected static ?string $heading = 'Conversion Rate Trend (Last 30 Days)';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('M j');

            // Simplified conversion rate calculation
            $visitors = \App\Models\Account::whereDate('created_at', $date)->count();
            $orders = Order::whereDate('created_at', $date)->count();

            $conversionRate = $visitors > 0 ? ($orders / $visitors) * 100 : 0;
            $data[] = round($conversionRate, 2);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Conversion Rate (%)',
                    'data' => $data,
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'borderColor' => 'rgb(245, 158, 11)',
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
