<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentIdToLocationsTable extends Migration
{
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->foreignId('department_id')->constrained()->onDelete('cascade')->after('longitude'); // Add department_id
        });
    }

    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['department_id']); // Drop foreign key constraint
            $table->dropColumn('department_id'); // Remove the column
        });
    }
}
