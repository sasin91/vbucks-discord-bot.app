<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static static staff()
 * @method static static customer()
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable
{
    const string ROLE_STAFF = 'staff';
    const string ROLE_CUSTOMER = 'customer';

    use Billable;
    use CausesActivity, LogsActivity;
    use HasApiTokens, HasFactory, Notifiable;
    use HasPanelShield;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'discord_id',
        'discord_nickname',
        'discord_metadata',
        'avatar',
        'phone',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pm_last_four',
        'stripe_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'trial_ends_at' => 'datetime',
    ];

    public static function defaultCheckoutCustomerEmail(): string
    {
        $appDomain = parse_url(config('app.url'), PHP_URL_HOST);
        return 'default-checkout-customer@'.$appDomain;
    }

    public static function defaultCheckoutCustomer(): User
    {
        return self::query()
            ->where('email', self::defaultCheckoutCustomer())
            ->firstOrFail();
    }

    public function scopeCustomer(Builder|self $query): void
    {
        $query->hasRole(self::ROLE_CUSTOMER);
    }

    public function scopeStaff(Builder|self $query): void
    {
        $query->hasRole(self::ROLE_STAFF);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logExcept([
                'password',
                'remember_token',
            ]);
    }
}
