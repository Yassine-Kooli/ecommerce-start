<?php

namespace App\Filament\Widgets;

use App\Models\Account;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use TomatoPHP\FilamentEcommerce\Models\Cart;
use TomatoPHP\FilamentEcommerce\Models\Order;

class AnalyticsStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalVisitors = Account::count(); // Placeholder - you'd integrate with analytics
        $conversionRate = $this->calculateConversionRate();
        $averageOrderValue = Order::where('status', 'completed')->avg('total');
        $cartAbandonmentRate = $this->calculateCartAbandonmentRate();

        return [
            Stat::make('Total Visitors', number_format($totalVisitors))
                ->description('Unique visitors')
                ->descriptionIcon('heroicon-m-eye')
                ->color('primary'),

            Stat::make('Conversion Rate', number_format($conversionRate, 2).'%')
                ->description('Visitors to customers')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Avg. Order Value', '$'.number_format($averageOrderValue, 2))
                ->description('Per completed order')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),

            Stat::make('Cart Abandonment', number_format($cartAbandonmentRate, 1).'%')
                ->description('Abandoned carts')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('danger'),
        ];
    }

    private function calculateConversionRate(): float
    {
        $totalVisitors = Account::count();
        // Count unique customers who have placed orders using the relationship
        $totalCustomers = Account::whereHas('orders')->count();

        return $totalVisitors > 0 ? ($totalCustomers / $totalVisitors) * 100 : 0;
    }

    private function calculateCartAbandonmentRate(): float
    {
        $totalCarts = Cart::distinct('account_id')->count('account_id');
        $completedOrders = Order::where('status', 'completed')->count();

        return $totalCarts > 0 ? (($totalCarts - $completedOrders) / $totalCarts) * 100 : 0;
    }
}
