<?php

class RegisterUsersTest extends FeatureTestCase
{
	public function test_register_user()
	{
		//Having
		$name = 'Hector';
		$username = 'hlavoe';
		$password = '123123';

		//When
		$this->visitRoute('register')
			->type($username,'username')
			->type($password,'password')
			->type($password,'password_confirmation')
			->type($name,'name')
			->press('Register');

		//Then
		$this->seeInDatabase('users', [
			'username' => $username,
			'name' => $name
		]);

		//Test a user is redirected to logim
		$this->seePageIs(route('home'));
	}

	public function test_register_user_form_validation()
	{
		$this->visitRoute('register')
			->press('Register')
			->seeErrors([
				'name' => 'The name field is required',
				'username' => 'The username field is required',
				'password' => 'The password field is required',
			]);

	}
}