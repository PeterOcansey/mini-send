<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('from');
            $table->string('to');
            $table->string('subject');
            $table->mediumText('content_text')->nullable();
            $table->longText('content_html')->nullable();
            $table->string('status')->default('POSTED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_transactions');
    }
}
