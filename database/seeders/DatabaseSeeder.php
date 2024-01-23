<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $customer = Role::create(['name' => User::ROLE_CUSTOMER]);
        $staff = Role::create(['name' => User::ROLE_STAFF]);

        $defaultCheckoutCustomer = User::factory()->create(['email' => User::defaultCheckoutCustomerEmail()]);
        $defaultCheckoutCustomer->assignRole($customer);
    }
}
