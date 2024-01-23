<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VBuck extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'character_name',
        'amount',
        'const',
        'delivered_at',
        'delivered_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'const' => 'decimal',
        'delivered_at' => 'timestamp',
        'delivered_by' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class);
    }

    public function deliveredBy(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }
}
