<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
            'name' => 'Jane',
            'email' => 'jane@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $employee2 = User::factory()->create([
            'name' => 'Eve',
            'email' => 'eve@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $store1 = Store::factory()->create();
        $store2 = Store::factory()->create();

        $store1->users()->attach([
            $owner1->id => ['role' => 'owner'],
            $owner2->id => ['role' => 'owner'],
            $employee1->id => ['role' => 'employee'],
        ]);
        $store2->users()->attach([
            $owner3->id => ['role' => 'owner'],
            $employee2->id => ['role' => 'employee'],
        ]);
    }
}
