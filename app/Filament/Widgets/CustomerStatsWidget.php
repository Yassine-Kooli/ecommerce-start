<?php

namespace App\Filament\Widgets;

use App\Models\Account;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use TomatoPHP\FilamentEcommerce\Models\Order;

class CustomerStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCustomers = Account::count();
        $newCustomersThisMonth = Account::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $activeCustomers = Account::whereHas('orders', function ($query) {
            $query->where('created_at', '>=', now()->subDays(30));
        })->count();
        $averageOrderValue = Order::where('status', 'completed')->avg('total');

        return [
            Stat::make('Total Customers', number_format($totalCustomers))
                ->description('All registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('New This Month', number_format($newCustomersThisMonth))
                ->description('New registrations')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('success'),

            Stat::make('Active Customers', number_format($activeCustomers))
                ->description('Ordered in last 30 days')
                ->descriptionIcon('heroicon-m-heart')
                ->color('info'),

            Stat::make('Avg. Order Value', '$'.number_format($averageOrderValue, 2))
                ->description('Per completed order')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
        ];
    }
}
