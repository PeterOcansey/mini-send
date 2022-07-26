<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uid' => $this->faker->uuid(),
            'from' => $this->faker->unique()->email,
            'to' => $this->faker->unique()->email,
            'subject' => $this->faker->realText( $this->faker->numberBetween( 10,20 ) ),
            'content_text' => $this->faker->text(),
            'content_html' => $this->faker->randomHtml( 2,3 ),
            'status' => "PENDING" 
        ];
    }
}
