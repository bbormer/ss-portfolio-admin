<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Config;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\NotificationResource;


class EditNotification extends EditRecord
{
    protected static string $resource = NotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->hidden(),
        ];
    }
}
