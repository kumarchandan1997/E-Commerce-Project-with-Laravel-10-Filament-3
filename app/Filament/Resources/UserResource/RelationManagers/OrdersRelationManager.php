<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use App\Models\Order;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action as ActionsAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('id')
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')->label('Order Id')->searchable(),
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

            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                ActionsAction::make('View Order')
                    ->url(function (Order $record): string {
                        return OrderResource::getUrl('view', ['record' => $record]);
                    })
                    ->color('info')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
