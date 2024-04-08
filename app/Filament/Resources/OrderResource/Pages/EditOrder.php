<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
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
