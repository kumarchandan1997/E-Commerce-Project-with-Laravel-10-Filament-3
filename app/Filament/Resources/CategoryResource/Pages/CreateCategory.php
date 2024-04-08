<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;


    protected function getSavedNotification(): ?Notification
    {
     return Notification::make()->success()
         ->title('Category Created')
         ->body('Category has been Created successfully !');
   }

    protected function getRedirectUrl(): string
    {
     return $this->getResource()::getUrl('index');
    }
}
