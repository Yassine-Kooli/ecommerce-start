<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class TrafficSourcesWidget extends ChartWidget
{
    protected static ?string $heading = 'Traffic Sources';
    
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // This would typically come from Google Analytics or similar
        // For now, we'll use sample data
        return [
            'datasets' => [
                [
                    'label' => 'Traffic Sources',
                    'data' => [45, 25, 15, 10, 5],
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                    ],
                ],
            ],
            'labels' => ['Organic Search', 'Direct', 'Social Media', 'Email', 'Referral'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
