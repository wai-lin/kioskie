<?php

namespace Database\Seeders;

use App\Enums\StoreRole;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StoreUserSeeder extends Seeder
{
    public function run(): void
    {
        $owner1 = User::factory()->create([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $owner2 = User::factory()->create([
            'name' => 'Alice',
            'email' => 'alice@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $owner3 = User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $employee1 = User::factory()->create([
            'name' => 'Dave',
            'email' => 'dave@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $employee2 = User::factory()->create([
            'name' => 'Eve',
            'email' => 'eve@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $store1 = Store::factory()->create();
        $store2 = Store::factory()->create();
        $store3 = Store::factory()->create();

        $store1->users()->attach([
            $owner1->id => ['role' => StoreRole::OWNER->value],
            $owner2->id => ['role' => StoreRole::OWNER->value],
            $employee1->id => ['role' => StoreRole::EMPLOYEE->value],
        ]);
        $store2->users()->attach([
            $owner3->id => ['role' => StoreRole::OWNER->value],
            $employee2->id => ['role' => StoreRole::EMPLOYEE->value],
        ]);
        $store3->users()->attach([
            $owner2->id => ['role' => StoreRole::OWNER->value],
        ]);

        $stores = Store::factory(25)->create();
        foreach ($stores as $store) {
            $store->users()->attach([
                $owner1->id => ['role' => StoreRole::OWNER->value],
            ]);
        }
    }
}
