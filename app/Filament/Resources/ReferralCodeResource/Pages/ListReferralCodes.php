<?php

namespace App\Filament\Resources\ReferralCodeResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\ReferralCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReferralCodes extends ManageRecords
{
    protected static string $resource = ReferralCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
