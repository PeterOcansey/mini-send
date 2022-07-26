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
            'from' => "ocanseypeter@gmail.com",
            'to' => "ptodeveloper@gmail.com",
            'subject' => "Hello mail",
            'content_text' => "my test content",
            'content_html' => "<p>my html content</h>",
            'status' => "PENDING" 
        ];
    }
}
