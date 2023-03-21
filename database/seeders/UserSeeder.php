<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        $ExampleUser = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        for ($i = 1; $i < count(\App\Enums\Permission::cases()) + 1; $i++) {
            UserPermission::query()
                ->create([
                    'user_id' => $ExampleUser -> id,
                    'permission_id' => $i,
                ]);
        }
    }
}
