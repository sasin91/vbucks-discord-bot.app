<?php

namespace App\Models;

use App\Data\CheckoutData;
use App\Data\VBuckData;
use App\Enums\OrderStatus;
use App\Services\CheckoutService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Laravel\Cashier\Checkout;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference',
        'customer_id',
        'status',
        'status_reason',
        'total_cost',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => OrderStatus::class,
        'customer_id' => 'integer',
        'total_cost' => 'decimal',
    ];

    public static function fromCheckoutData(CheckoutData $checkoutData)
    {
        $order = new Order();
        $order->customer()->associate($checkoutData->customer);
        $order->status = OrderStatus::NEW;
        $order->total_cost = 0;
        $order->saveOrFail();

        $checkoutData->vbucks->each(function (VBuckData $vBuckData) use ($order) {
            $order->vbucks()->create($vBuckData->all());
        });

        // this should be filled thru stripe price
        // $order->total_cost = $order->vbucks->sum('amount');
        $order->saveOrFail();

        return $order;
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(static function (Order $order) {
            if (blank($order->reference)) {
                $order->reference = (string) Str::orderedUuid();
            }
        });

        parent::booted();
    }

    public function checkout(): Checkout
    {
        return app(CheckoutService::class)->checkout($this);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function deliverer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deliverer_id');
    }

    public function vbucks(): HasMany
    {
        return $this->hasMany(VBuck::class);
    }
}
