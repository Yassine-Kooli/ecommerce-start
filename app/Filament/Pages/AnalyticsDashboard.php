<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AnalyticsDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static string $view = 'filament.pages.analytics-dashboard';
    
    protected static ?string $navigationLabel = 'Analytics Dashboard';
    
    protected static ?string $title = 'Analytics Dashboard';
    
    protected static ?int $navigationSort = 5;
    
    protected static ?string $navigationGroup = 'Dashboards';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\AnalyticsStatsWidget::class,
            \App\Filament\Widgets\RevenueChartWidget::class,
            \App\Filament\Widgets\ConversionRateWidget::class,
            \App\Filament\Widgets\TrafficSourcesWidget::class,
        ];
    }
}
