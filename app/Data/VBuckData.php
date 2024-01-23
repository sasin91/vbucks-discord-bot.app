<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class VBuckData extends Data
{
    public function __construct(
        #[Rule(['required_with:vbucks', 'integer', 'min:50', 'max:50000'])]
        public int $amount,
        #[Rule('string', 'max:255', 'alnum')]
        public string $characterName
    ) {
        //
    }
}
