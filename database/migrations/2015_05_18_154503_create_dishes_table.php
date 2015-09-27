<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Dish;
use App\User;

class CreateDishesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dishes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->decimal('price', 8, 2);
            $table->string('currency');
            $table->string('name');
            $table->text('description');
            $table->decimal('rating', 3, 1);
			$table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
		});

		User::find(1)->dishes()->create([
			'price' => 4.0,
			'name' => 'Mousse au chocolat',
			'rating' => 4.6
		]);

		User::find(1)->dishes()->create([
			'price' => 3.0,
			'name' => 'Tarte au citron meringuée',
			'rating' => 4.2
		]);

		User::find(2)->dishes()->create([
			'price' => 5.0,
			'name' => 'Risotto au poulet',
			'rating' => 3.2
		]);

		User::find(3)->dishes()->create([
			'price' => 7.0,
			'name' => 'Filet de dorade sauce citronnelle',
			'rating' => 4.1
		]);

		User::find(3)->dishes()->create([
			'price' => 6.0,
			'name' => 'Pizza maison',
			'rating' => 4.2
		]);

		User::find(3)->dishes()->create([
			'price' => 5.0,
			'name' => 'Raviolis au calmar',
			'rating' => 4.1
		]);

		User::find(4)->dishes()->create([
			'price' => 3.5,
			'name' => 'Soupe aux épinards',
			'rating' => 4.7
		]);

		User::find(5)->dishes()->create([
			'price' => 5.0,
			'name' => 'Tagliatelles au saumon',
			'rating' => 3.2
		]);

		User::find(5)->dishes()->create([
			'price' => 7.0,
			'name' => 'Blanquette de veau',
			'rating' => 4.1
		]);

		User::find(5)->dishes()->create([
			'price' => 5.50,
			'name' => 'Lapin aux pruneaux',
			'rating' => 4.2
		]);

		User::find(6)->dishes()->create([
			'price' => 5.0,
			'name' => 'Salades de gésiers au roquefort',
			'rating' => 4.0
		]);

		User::find(6)->dishes()->create([
			'price' => 4.0,
			'name' => 'Fraisier royal',
			'rating' => 4.2
		]);

		User::find(7)->dishes()->create([
			'price' => 5.0,
			'name' => 'Lasagnes',
			'rating' => 4.4
		]);

		User::find(8)->dishes()->create([
			'price' => 4.50,
			'name' => 'Tartiflette',
			'rating' => 4.1
		]);

		User::find(8)->dishes()->create([
			'price' => 3.0,
			'name' => 'Eclair au chocolat',
			'rating' => 3.8
		]);

		User::find(9)->dishes()->create([
			'price' => 4.50,
			'name' => 'Soupe de poisson',
			'rating' => 3.7
		]);

		User::find(9)->dishes()->create([
			'price' => 4.50,
			'name' => 'Fromage blanc à la menthe et fruits rouges',
			'rating' => 2.8
		]);

		User::find(9)->dishes()->create([
			'price' => 3.50,
			'name' => 'Soupe aux oignons et radis',
			'rating' => 4.0
		]);

		User::find(10)->dishes()->create([
			'price' => 5.0,
			'name' => 'Riz pilaf et fruits de mer',
			'rating' => 4.2
		]);

		User::find(10)->dishes()->create([
			'price' => 4.0,
			'name' => 'Beignets crevette & fromage de chèvre',
			'rating' => 4.5
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//\DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('dishes');
		//\DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
