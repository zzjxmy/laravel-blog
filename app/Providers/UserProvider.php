<?php
namespace App\Providers;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class UserProvider extends EloquentUserProvider{
	public function validateCredentials(UserContract $user, array $credentials)
	{
		$plain = $credentials['password'];

		return md5($plain) === $user->getAuthPassword();
	}
}