<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EmailTransaction;

class HttpTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test fetching email transactions endpoint
     * Assert our endpoint is ok
     * Assert our endpoint returns a valid json strucutre
     *  
     * @test 
     * */
    public function email_transactions_can_be_fetched()
    {
        $this->withoutExceptionHandling();

        EmailTransaction::factory()->count(10)->create();

        $response = $this->get("/api/emails");
        $response->assertStatus(200);

        $response->assertJsonStructure( ['code','message', 'data'] );
    }

    /**
     * Test sending email transactions endpoint
     * Assert our endpoint is ok
     * Assert our endpoint returns a valid json strucutre
     *  
     * @test 
     * */
    public function email_can_be_sent()
    {
        $this->withoutExceptionHandling();

        $data = [
            'uid' => "77u7u88yt3490ur",
            'from' => "test@minisend.com",
            'to' => "test@minisend.com",
            'subject' => "Hello test",
            'content_text' => "Hello test content"
        ];

        $response = $this->post( "/api/emails", $data );
        $response->assertStatus( 200 );
        $response->assertJsonStructure( ['code','message', 'data'] );
        $response->assertJson( ['message' => "Product Created!"] );
        $response->assertJson( ['data' => ['data' => $data ]] );

        
    }
}
