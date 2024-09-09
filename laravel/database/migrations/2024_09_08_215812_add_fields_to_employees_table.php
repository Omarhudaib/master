<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('national_id')->nullable(); // الرقم الوطني
            $table->enum('marital_status', ['single', 'married'])->nullable(); // متزوج/أعزب
            $table->string('phone_number')->nullable(); // رقم الهاتف
            $table->string('employee_identifier')->nullable(); // معرف الموظف
            $table->integer('sick_leaves')->default(14); // الاجازات المرضية
            $table->integer('annual_vacation_days')->default(14); // العطل والاجازات السنوية
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn([
                'national_id',
                'marital_status',
                'phone_number',
                'employee_identifier',
                'sick_leaves',
                'annual_vacation_days'
            ]);
        });
    }

};
