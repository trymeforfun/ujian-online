<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('Users', function (Blueprint $table)
        // {
        //     $table->id();
        //     $table->string('username');
        //     $table->string('password');
        //     $table->string('email');
        //     $table->integer('is_active');
        //     $table->enum('level', ['staff', 'guru']);
        //     $table->timestamps();
        // });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
