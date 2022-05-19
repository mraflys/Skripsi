<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_transactions');
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->string('code_area')->nullable();
            $table->double('nominal');
            $table->text('description')->nullable();
            $table->tinyInteger('reviewed_status')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->uuid('reviewed_by')->nullable();
            $table->uuid('request_By')->nullable();
            $table->text('url_path')->nullable();
            $table->text('file_name')->nullable();
            $table->string('file_mime')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('request_By')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
