<?php

namespace App\Data;

use App\Models\User;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CheckoutData extends Data
{
    public function __construct(
        public ?User $customer,
        #[DataCollectionOf(VBuckData::class)]
        public DataCollection $vbucks
    ) {
        //
    }
}
