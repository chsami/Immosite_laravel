<?php

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
			//persoonlijke gegevens
			$table->string('email', 60)->unique();
			$table->string('username', 60)->unique();
			$table->string('password', 60);
			$table->string('firstname');
			$table->string('lastname');
			$table->string('country');
			$table->integer('zipcode')->unsigned();
			$table->string('region');
			$table->string('city');
			$table->string('street');
			$table->integer('street_number')->unsigned();
			$table->string('mailbox')->nullable();
			$table->integer('cellphone');
			$table->enum('salutation', array('Mijnheer', 'Mevrouw'));
            $table->rememberToken();
            $table->timestamps();
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
