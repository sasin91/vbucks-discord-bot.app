<?php

namespace App\Filament\Resources\OrderResource\Actions;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Notifications\YourOrderIsBeingDelivered;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Actions\Contracts\HasActions;

class CompleteAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'complete';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function () {
            $this->process(function (array $data, HasActions $livewire, Order $record) {
                $record->deliverer()->associate(auth()->user());
                $record->status = OrderStatus::PENDING;
                $record->saveOrFail();

                $record->customer->notify(new YourOrderIsBeingDelivered($record));
            });

            $this->success();
        });
    }
}
