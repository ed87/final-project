<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'name' => 'company_' . $this->faker->word,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'description' =>  $this->faker->text(300),
            'status' => $this->faker->randomElement([Company::STATUS_ACCEPTED, Company::STATUS_PENDING, Company::STATUS_REJECTED]),
        ];
    }
}
