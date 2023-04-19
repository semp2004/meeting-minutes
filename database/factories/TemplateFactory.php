<?php

namespace Database\Factories;

use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TemplateFactory extends Factory
{
    protected $model = Template::class;

    public function definition(): array
    {
        $User = User::all()->random()->first();
        return [
            'user_id' => $User->id,
            'name' => $this->faker->word(),
            'header' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
