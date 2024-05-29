<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'invoice_id' => Invoice::factory(),
            'ref_id' => $this->faker->uuid(),
            'amount' => $this->faker->numberBetween(1,2000),
            'payment_date' => $this->faker->dateTimeThisDecade(),
            'payment_method' => PaymentMethod::factory(),
        ];
    }
}
