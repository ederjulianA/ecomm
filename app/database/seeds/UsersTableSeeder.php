<?php

class UsersTableSeeder extends Seeder {
	public function run(){
		$user = new User;
		$user->firstname = 'Eder';
		$user->lastname  = 'Alvarez';
		$user->email 	 = 'ederalvarez2091057@gmail.com';
		$user->password  = Hash::make('mypassword');
		$user->telephone = '123456789';
		$user->admin     = 1;
		$user->save();
 	}
}