<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Carbon\Carbon;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentEcommerce\Models\OrderLog;
use TomatoPHP\FilamentEcommerce\Models\OrdersItem;
use TomatoPHP\FilamentEcommerce\Models\Product;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected static string $view = 'filament-ecommerce::orders.show';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print')
                ->icon('heroicon-o-printer')
                ->label(trans('filament-ecommerce::messages.orders.actions.print'))
                ->openUrlInNewTab()
                ->url(route('order.print', $this->getRecord()->id)),
            Actions\DeleteAction::make()->icon('heroicon-o-trash'),
            Actions\EditAction::make()->icon('heroicon-o-pencil-square')->color('warning'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['items'] = $this->getRecord()->ordersItems->toArray();
        return parent::mutateFormDataBeforeFill($data); // TODO: Change the autogenerated stub
    }
}
