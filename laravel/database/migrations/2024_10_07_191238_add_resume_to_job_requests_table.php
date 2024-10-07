<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResumeToJobRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('job_requests', function (Blueprint $table) {
            $table->string('resume_path')->nullable(); // Adding a new column for resume path
        });
    }

    public function down()
    {
        Schema::table('job_requests', function (Blueprint $table) {
            $table->dropColumn('resume_path'); // Remove the column if rolling back
        });
    }
}
