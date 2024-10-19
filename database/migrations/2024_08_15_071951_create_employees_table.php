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
            $table->string('name');
            $table->string('position');
            $table->string('department');
            $table->string('nip')->unique();
            $table->integer('working_period');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
