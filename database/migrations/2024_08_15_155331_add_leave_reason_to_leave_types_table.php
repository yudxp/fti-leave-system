<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeaveReasonToLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_types', function (Blueprint $table) {
            $table->string('leave_reason')->nullable(); // Add the leave_reason column
            $table->enum('applicable_for', ['PNS', 'P3K', 'Both'])->default('Both'); // Jenis pegawai yang berlaku
            $table->integer('default_days')->default(12); // Default jumlah hari cuti per tahun
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_types', function (Blueprint $table) {
            $table->dropColumn('leave_reason'); // Remove the leave_reason column
        });
    }
}
