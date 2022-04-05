<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	protected $model = 'user';

	public function rules(): array
	{
		return [
			'email' => 'required|email|max:191',
			'password' => 'required|max:64'
		];
	}
}
