<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingFactory extends Factory
{
    protected $model = Meeting::class;

    public function definition(): array
    {
        $user = User::all()->random()->first();

        return [
            'name' => $this->faker->name,
            'user_id' => $user->id,
            'template_id' => null,
            'planned_time' => $this->faker->dateTime(),
        ];
    }
}
