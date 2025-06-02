<?php

namespace App\Filament\Resources\SearchResource\Pages;

use App\Filament\Resources\SearchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSearch extends EditRecord
{
    protected static string $resource = SearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
