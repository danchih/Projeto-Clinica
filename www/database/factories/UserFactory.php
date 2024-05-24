<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'password' => bcrypt('password123'), // you can change this if needed
            'remember_token' => Str::random(10),
        ];
    }
}
