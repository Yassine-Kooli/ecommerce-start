<?php

namespace App\Filament\Widgets;

use App\Models\Account as ModelsAccount;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use TomatoPHP\FilamentEcommerce\Models\Order;
use TomatoPHP\FilamentEcommerce\Models\Product;

class EcommerceOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Revenue calculations
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $todayRevenue = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total');
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Order calculations
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $todayOrders = Order::whereDate('created_at', today())->count();

        // Product calculations
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_activated', true)->count();
        $outOfStockProducts = Product::where('is_in_stock', false)->count();

        // Customer calculations
        $totalCustomers = ModelsAccount::count();
        $newCustomersToday = ModelsAccount::whereDate('created_at', today())->count();

        return [
            Stat::make('Total Revenue', '$'.number_format($totalRevenue, 2))
                ->description('Today: $'.number_format($todayRevenue, 2))
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total Orders', number_format($totalOrders))
                ->description('Pending: '.number_format($pendingOrders).' | Today: '.number_format($todayOrders))
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),

            Stat::make('Products', number_format($totalProducts))
                ->description('Active: '.number_format($activeProducts).' | Out of Stock: '.number_format($outOfStockProducts))
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),

            Stat::make('Customers', number_format($totalCustomers))
                ->description('New today: '.number_format($newCustomersToday))
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
