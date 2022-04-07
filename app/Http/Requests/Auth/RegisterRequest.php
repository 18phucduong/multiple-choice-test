<?php

namespace App\Http\Requests\Auth;
use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{
	protected $model = 'user';

	public function rules(): array
	{
		return [
            'name' => 'required',
			'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users',
			'password' => 'required|min:8|max:50|confirmed',
		];
	}
}
