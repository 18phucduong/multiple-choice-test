<?php

namespace App\Http\Requests\Auth;
use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
	protected $model = 'user';

	public function rules(): array
	{
		return [
			'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
			'password' => 'required|min:8|max:50',
		];
	}
}
