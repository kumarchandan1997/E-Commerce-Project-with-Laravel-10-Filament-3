<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action as ActionsAction;
use App\Models\Order;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ? int $sort  = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at','desc')
            ->columns([
                TextColumn::make('id')->label('Order Id')->searchable(),
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('grand_total')->money('INR'),
                TextColumn::make("status")->badge()
                ->color(function (string $state): string {
                    return match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped', 'delivered' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    };
                })->icons([
                    'new' => 'heroicon-m-sparkles',
                    'processing' => 'heroicon-m-arrow-path',
                    'shipped' => 'heroicon-m-truck',
                    'delivered' => 'heroicon-m-check-badge',
                    'cancelled' => 'heroicon-m-x-circle'
                ])->sortable(),
                TextColumn::make('payment_method')->sortable()->searchable(),
                TextColumn::make('payment_status')->sortable()->badge()->searchable(),
                TextColumn::make('created_at')->label('Order Date')->dateTime(),
            ])->actions([
                ActionsAction::make('View Order')
                    ->url(function (Order $record): string {
                        return OrderResource::getUrl('view', ['record' => $record]);
                    })
                    ->color('info')
                    ->icon('heroicon-o-eye'),
                // Tables\Actions\DeleteAction::make(),
            ]);
    }
}
