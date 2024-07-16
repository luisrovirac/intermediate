<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assistant>
 */
class AssistantFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'typesex_id' => 1,
            'name' => Str::random(10),
            'infoLoraIni' => Str::random(10),
            'infoLoraEnd' => Str::random(10),
            'voice' => Str::random(10),
            'details' => Str::random(10),
        ];
    }

}
