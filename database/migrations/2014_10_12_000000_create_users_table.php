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
            $table->double('rating', 2, 1);
            $table->string('address_google_place_id');
            $table->string('city_google_place_id');
            $table->double('lat', 9, 7)->index();
            $table->double('lng', 9, 7)->index();
			$table->timestamps();
		});

		User::create([
			'name' => 'guigui',
			'email' => 'guigui@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJrQbIFN9x5kcRaat6G5YRso8',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ',
			'lat' => 48.8550429,
			'lng' => 2.3403490
		]);

		User::create([
			'name' => 'Norah',
			'email' => 'norah@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJXen5Ns5x5kcRWQ2o-QAD7mY',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ',
			'lat' => 48.8455837,
			'lng' => 2.3286534
		]);

		User::create([
			'name' => 'Camille',
			'email' => 'camille@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJaw-1XOtx5kcR50EKFS00-DE',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ',
			'lat' => 48.8371591,
			'lng' => 2.3470280
		]);

		User::create([
			'name' => 'Henry',
			'email' => 'henry@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJv2p1v_Nx5kcRbku-M9o1g4U',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ',
			'lat' => 48.8390295,
			'lng' => 2.3585175
		]);

		User::create([
			'name' => 'Yura',
			'email' => 'yura@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJQdHRjOxx5kcRWiw25AfNCvU',
			'city_google_place_id' => 'ChIJD7fiBh9u5kcRYJSMaMOCCwQ',
			'lat' => 48.8379890,
			'lng' => 2.3498913
		]);

		User::create([
			'name' => 'Yannick',
			'email' => 'yannick@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJR3LKmZdy5kcR0rfq11MDbZk',
			'city_google_place_id' => 'ChIJTcXqm6Ny5kcRQDeLaMOCCwQ',
			'lat' => 48.8433447,
			'lng' => 2.4311599
		]);

		User::create([
			'name' => 'Nady',
			'email' => 'nady@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJITqiQj9s5kcRS6Vx0_X-ozg',
			'city_google_place_id' => 'ChIJr-kEdj1s5kcRKIV0SDMRazA',
			'lat' => 48.9122336,
			'lng' => 2.3937637
		]);

		User::create([
			'name' => 'ducj',
			'email' => 'ducj@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJacwkL0ds5kcRpTD6taNJIRw',
			'city_google_place_id' => 'ChIJr-kEdj1s5kcRKIV0SDMRazA',
			'lat' => 48.9101432,
			'lng' => 2.3966285
		]);

		User::create([
			'name' => 'Victor',
			'email' => 'victor@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJs9NJTUMN5kcReVQb073KWrw',
			'city_google_place_id' => 'ChIJkyBwzV4N5kcRQDmLaMOCCwQ',
			'lat' => 48.8432477,
			'lng' => 2.4733450
		]);

		User::create([
			'name' => 'nicolaS',
			'email' => 'nicolas@gmail.com',
			'password' => Hash::make('123456'),
			'address_google_place_id' => 'ChIJFUrki1Bt5kcRuy5x0PSsNzM',
			'city_google_place_id' => 'ChIJhe8OU0Vt5kcR8FvEsG18qqM',
			'lat' => 48.8612446,
			'lng' => 2.4471052
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
