<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = array_map(fn($value) => strtoupper($value->name), \App\Enums\Permission::cases());

        foreach ($permissions as $permission) {
            Permission::query()
                ->create([
                    'name' => $permission,
                ]);
        }
    }
}
