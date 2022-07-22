<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaceDatasetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('face_datasets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_user');
            $table->text('url_path');
            $table->string('file_name');
            $table->string('file_mime');
            $table->string('python_folder')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('face_datasets');
    }
}
