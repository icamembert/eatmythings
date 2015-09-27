<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		User::create([
			'name' => 'Guillaume',
			'email' => 'guillaume@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'Norah',
			'email' => 'norah@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'Camille',
			'email' => 'camille@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'Henry',
			'email' => 'henry@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'Yura',
			'email' => 'yura@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'Yannick',
			'email' => 'yannick@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'Nady',
			'email' => 'nady@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'ducj',
			'email' => 'ducj@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'Victor',
			'email' => 'victor@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'nicolaS',
			'email' => 'nicolas@gmail.com',
			'password' => Hash::make('123456')
		]);

		User::create([
			'name' => 'bBob',
			'email' => 'bbob@gmail.com',
			'password' => Hash::make('123456')
		]);
	}
}