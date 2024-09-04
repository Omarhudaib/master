<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employee_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('related_employee_id')->constrained('employees')->onDelete('cascade');
            $table->enum('relation_type', ['Manager', 'Supervisor', 'Mentor', 'Peer']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_relations');
    }
};

