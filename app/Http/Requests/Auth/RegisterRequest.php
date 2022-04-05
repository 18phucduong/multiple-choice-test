<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
	protected $model = 'user';

	public function rules(): array
	{
		return [
            'name' => 'required',
			'email' => 'required|email|unique:users|max:191',
			'password' => 'required|max:64||confirmed'
		];
	}
}
