<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
Use App\Models\Order;
use Filament\Widgets\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        $averagePrice = Order::query()->avg('grand_total');
        $averagePriceFormatted = '$ ' . number_format($averagePrice, 2);

        return [
            Stat::make('New Orders', Order::query()->where('status','new')->count()),
            Stat::make('Order Processing', Order::query()->where('status','processing')->count()),
            Stat::make('Order Shipped', Order::query()->where('status','shipped')->count()),
            Stat::make('Average Price', $averagePriceFormatted),
        ];
    }
}
