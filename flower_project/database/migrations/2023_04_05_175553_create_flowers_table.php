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
        {
            Schema::create('flowers', function (Blueprint $table){
                $table->id();
                $table->string('flower_name', 100);
                $table->string('flower_type', 100);
                $table->foreignId('store_id');
           
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flowers');
    }
};
