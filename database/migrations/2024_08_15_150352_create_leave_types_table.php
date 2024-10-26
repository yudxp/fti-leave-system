<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Insert the leave types
        DB::table('leave_types')->insert([
            ['name' => 'Annual Leave'],
            ['name' => 'Sick Leave'],
            ['name' => 'Important Leave'],
            ['name' => 'Long Leave'],
            ['name' => 'Maternity Leave'],
            ['name' => 'Leave Without State Expenses'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_types');
    }
}