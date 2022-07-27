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

        //EmailTransaction::factory()->count(10)->create();

        $response = $this->get("/api/emails");
        $response->assertStatus(200);

        $response->assertJsonStructure( ['code','message', 'data'] );

        // $response->assertJsonStructure(
        //     [
        //         'data' => [
        //                 'id',
        //                 'uid',
        //                 'from',
        //                 'to',
        //                 'subject',
        //                 'content_text',
        //                 'content_html',
        //                 'status',
        //                 'created_at',
        //                 'updated_at'
        //         ]
        //     ]
        // );
    }
}
