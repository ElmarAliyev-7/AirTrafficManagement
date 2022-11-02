<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        Admin::truncate();

        return [
            'name'    => 'Cəlal',
            'surname' => 'Səttarov',
            'image'   => asset('user.jpg'),
            'email'   => 'celal@gmail.com',
            'password'=> Hash::make('Celal8212!'),
        ];
    }
}
