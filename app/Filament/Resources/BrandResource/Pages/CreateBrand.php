<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;

    protected function getRedirectUrl(): string
   {
    return $this->getResource()::getUrl('index');
   }


protected function getSavedNotification(): ?Notification
{
    return Notification::make()->success()
        ->title('Brand Created')
        ->body('Brand has been Created successfully !');
}
}
