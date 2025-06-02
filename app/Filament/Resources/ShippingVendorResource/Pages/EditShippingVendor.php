<?php

namespace App\Filament\Resources\ShippingVendorResource\Pages;

use App\Filament\Resources\ShippingVendorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShippingVendor extends EditRecord
{
    protected static string $resource = ShippingVendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
