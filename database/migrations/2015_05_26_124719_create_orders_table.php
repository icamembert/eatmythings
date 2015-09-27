<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->decimal('price', 8, 2);
            $table->string('currency');
            $table->integer('type_id')->unsigned();
            $table->string('comment');
            $table->integer('status_id')->unsigned();
            $table->timestamps();
            $table->timestamp('served_at');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		\DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('orders');
		\DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
