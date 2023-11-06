<?php

namespace Database\Factories;

use App\Models\UserRegister;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRegister>
 */
class UserRegisterFactory extends Factory
{
    protected $model = UserRegister::class;

    public function definition()
    {
        $indexedArray = array("1", "3");
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

        return [
            'line_token' => $this->faker->uuid,
            'line_img' => $this->faker->imageUrl,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'career_id' => random_int(1, 3), // Replace with appropriate values
            // 'career_id' => $indexedArray[array_rand($indexedArray)], // Replace with appropriate values
            'specialty_id' => random_int(1, 25), // Replace with appropriate values
            // 'specialty_id' => $indexedArray[array_rand($indexedArray)], // Replace with appropriate values
            'license_number' => $this->faker->randomNumber,
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => $this->faker->phoneNumber,
            'consented' => $this->faker->boolean,
            'agent' => null, // or $this->faker->word,
            'register_event' => null, // or $this->faker->word,
            'event' => null,
            'status' => 'pending', // or $this->faker->word,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}