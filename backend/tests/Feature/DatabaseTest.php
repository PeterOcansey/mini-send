<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EmailTransaction;

class DatabaseTest extends TestCase
{
    /**
     * Test an an email transactionn can be created
     *
     * @return void
     * 
     * @test
     */
    public function an_email_transction_can_be_created()
    {
        $this->assertModelExists( EmailTransaction::factory()->create() );
    }
}
