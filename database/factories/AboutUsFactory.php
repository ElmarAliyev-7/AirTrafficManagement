<?php

namespace Database\Factories;

use App\Models\AboutUs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutUs>
 */
class AboutUsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        AboutUs::truncate();

        return [
            'title'       => 'Air Traffic Management',
            'description' => 'Air Traffic Management Desc',
            'image'       => asset('air_traffic_management.png'),
        ];
    }
}
