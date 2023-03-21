<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    public function run(): void
    {
        Meeting::factory(10)->create();
    }
}
