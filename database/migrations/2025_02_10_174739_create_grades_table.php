<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id('gradeid');
            $table->foreignId('studentid')->constrained('students', 'studentid');
            $table->foreignId('courseid')->constrained('courses', 'id');
            $table->date('exam_date');
            $table->decimal('grade', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};