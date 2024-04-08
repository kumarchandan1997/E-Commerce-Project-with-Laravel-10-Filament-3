<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function getSavedNotification(): ?Notification
    {
     return Notification::make()->success()
         ->title('Order Updated')
         ->body('Order has been Updated successfully !');
   }

    protected function getRedirectUrl(): string
    {
     return $this->getResource()::getUrl('index');
    }
}


