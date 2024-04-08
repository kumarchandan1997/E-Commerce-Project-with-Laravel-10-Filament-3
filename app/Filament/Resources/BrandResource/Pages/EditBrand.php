<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditBrand extends EditRecord
{
    protected static string $resource = BrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
     return $this->getResource()::getUrl('index');
    }


 protected function getSavedNotification(): ?Notification
 {
     return Notification::make()
         ->success()
         ->title('Brand Updated')
         ->body('Brand has been Updated successfully !');
 }
}
