<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use TomatoPHP\FilamentEcommerce\Models\Account;
use TomatoPHP\FilamentLocations\Models\Country;
use Illuminate\Support\Facades\DB;

class CustomerLocationWidget extends ChartWidget
{
    protected static ?string $heading = 'Customers by Location';
    
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $locations = Account::select('country_id', DB::raw('count(*) as total'))
            ->whereNotNull('country_id')
            ->groupBy('country_id')
            ->with('country')
            ->orderBy('total', 'desc')
            ->limit(8)
            ->get();

        $labels = [];
        $data = [];
        
        foreach ($locations as $location) {
            if ($location->country) {
                $labels[] = $location->country->name;
                $data[] = $location->total;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Customers',
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
        return 'pie';
    }
}
