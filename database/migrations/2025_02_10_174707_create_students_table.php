<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('studentid');
            $table->string('fname');
            $table->string('lname');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('dateofb');
            $table->string('contactnumber');
            $table->string('email')->unique();
            $table->text('address');
            $table->date('enrollmentdate');
            $table->string('class'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};