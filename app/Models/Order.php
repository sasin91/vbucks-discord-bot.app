<?php

namespace App\Models;

use App\Data\CheckoutData;
use App\Data\VBuckData;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, HasUuids;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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

    public static function fromCheckoutData(CheckoutData $checkoutData, ?User $customer = null)
    {
        $order = new Order();
        $order->customer()->associate($customer ?? User::defaultCheckoutCustomer());
        $order->status = OrderStatus::NEW;
        $order->total_cost = 0;
        $order->saveOrFail();

        $checkoutData->vbucks->each(function (VBuckData $vBuckData) use ($order) {
            $order->vbucks()->create($vBuckData->all());
        });

        $order->total_cost = $order->vbucks->sum('amount');
        $order->saveOrFail();

        return $order;
    }

    public function checkout()
    {
        $stripePriceId = config('vbucks.stripe.price_id');
        $quantity = $this->vbucks->count();

        return $this->customer->checkout([$stripePriceId => $quantity], [
            'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'metadata' => [
                'order_id' => $this->id,
            ],
        ]);
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
