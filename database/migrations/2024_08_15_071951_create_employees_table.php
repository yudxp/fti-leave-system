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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->string('name');
            $table->string('position');
            $table->string('department');
            $table->string('nip')->unique();
            $table->date('start_working');
            $table->string('research_group_id')->nullable();
            // $table->string('email');
            $table->longText('signature')->nullable();
            // $table->string('signature');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
