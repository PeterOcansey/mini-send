<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EmailTransaction;

class HttpTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test matching property and search profiles endpoint
     * Assert our endpoint is ok
     * Assert our endpoint returns a valid json strucutre
     *  
     * @test 
     * */
    public function email_transactions_can_be_fetched()
    {
        $this->withoutExceptionHandling();

        EmailTransaction::factory()->count(10)->create();

        $response = $this->get("/api/email/transactions");
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                [
                        'id',
                        'name',
                        'description',
                        'units',
                        'price',
                        'image',
                        'created_at',
                        'updated_at'
                ]
            ]
        );
    }
}
