<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
     return Notification::make()->success()
         ->title('Category Updated')
         ->body('Category has been Updated successfully !');
   }

    protected function getRedirectUrl(): string
    {
     return $this->getResource()::getUrl('index');
    }
}
