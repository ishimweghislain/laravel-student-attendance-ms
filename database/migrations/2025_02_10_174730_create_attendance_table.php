<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentid')->constrained('students', 'studentid');
            $table->foreignId('courseid')->constrained('courses', 'id');
            $table->date('attendance_date');
            $table->enum('attendance_status', ['Present', 'Absent', 'Late']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendance');
    }
};