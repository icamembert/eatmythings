<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country');
            $table->string('iso_code');
            $table->string('time_zone');
            $table->string('home_phone');
            $table->string('mobile_phone');
            $table->string('about');
            $table->decimal('rating', 3, 1);
            $table->string('address_google_place_id');
            $table->string('city_google_place_id');
			$table->timestamps();
		});

		User::create([
			'name' => 'guigui',
			'email' => 'guigui@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJrQbIFN9x5kcRaat6G5YRso8',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ'
		]);

		User::create([
			'name' => 'Norah',
			'email' => 'norah@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJXen5Ns5x5kcRWQ2o-QAD7mY',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ'
		]);

		User::create([
			'name' => 'Camille',
			'email' => 'camille@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJaw-1XOtx5kcR50EKFS00-DE',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ'
		]);

		User::create([
			'name' => 'Henry',
			'email' => 'henry@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJv2p1v_Nx5kcRbku-M9o1g4U',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ'
		]);

		User::create([
			'name' => 'Yura',
			'email' => 'yura@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJQdHRjOxx5kcRWiw25AfNCvU',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ'
		]);

		User::create([
			'name' => 'Yannick',
			'email' => 'yannick@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJR3LKmZdy5kcR0rfq11MDbZk',
			'city_google_place_id' => 'ChIJTcXqm6Ny5kcRQDeLaMOCCwQ'
		]);

		User::create([
			'name' => 'Nady',
			'email' => 'nady@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJITqiQj9s5kcRS6Vx0_X-ozg',
			'city_google_place_id' => 'ChIJr-kEdj1s5kcRKIV0SDMRazA'
		]);

		User::create([
			'name' => 'ducj',
			'email' => 'ducj@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJacwkL0ds5kcRpTD6taNJIRw',
			'city_google_place_id' => 'ChIJr-kEdj1s5kcRKIV0SDMRazA'
		]);

		User::create([
			'name' => 'Victor',
			'email' => 'victor@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJs9NJTUMN5kcReVQb073KWrw',
			'city_google_place_id' => 'ChIJkyBwzV4N5kcRQDmLaMOCCwQ'
		]);

		User::create([
			'name' => 'nicolaS',
			'email' => 'nicolas@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJFUrki1Bt5kcRuy5x0PSsNzM',
			'city_google_place_id' => 'ChIJhe8OU0Vt5kcR8FvEsG18qqM'
		]);

		User::create([
			'name' => 'ChocoChef',
			'email' => 'chocochef@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'julie',
			'email' => 'julie@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'Martinedu14',
			'email' => 'martinedu14@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'cookiX',
			'email' => 'cookix@gmail.com',
			'password' => Hash::make('123456')
		]);

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		\DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('users');
		\DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
