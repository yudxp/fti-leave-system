<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('type')->unique();
            $table->timestamps();
        });

        // Insert the leave types
        DB::table('leave_types')->insert([
            ['type' => 'Annual Leave'],
            ['type' => 'Sick Leave'],
            ['type' => 'Important Leave'],
            ['type' => 'Long Leave'],
            ['type' => 'Maternity Leave'],
            ['type' => 'Leave Without State Expenses'],
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