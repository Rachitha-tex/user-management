<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('id_number');
            $table->date('dob');
            $table->integer('age');
            $table->string('name');
            $table->string('pnumber');
            $table->string('address')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            /* $table->foreignId('rel_id')->constrained('religions');
            $table->foreignId('nationality_id')->constrained('nationalities'); */
            $table->string('user_img')->nullable();
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
        Schema::dropIfExists('users');
    }
};
