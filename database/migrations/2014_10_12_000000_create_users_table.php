<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('user_type',['super_admin','admin','tonya','super','shop'])->default('tonya');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            //$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Time of creation');
			//$table->timestamp('updated_at')->default('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP')->comment('last updated time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
