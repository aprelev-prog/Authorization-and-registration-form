<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserTable extends Migration
{
    /**
     * Run the migrations.
     */
  
        public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments(column: 'id');
            $table->string(column: 'email', length:255)->nullable(value:false)->unique(indexName:'email');
            $table->string(column: 'password', length:255)->nullable(value:false);
            $table->string(column: 'remember_token', length:100)->nullable(value:true);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
