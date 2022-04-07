<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class RegisterRequest extends FormRequest
{
	protected $model = 'user';

	public function rules(): array
	{
		return [
            'name' => 'required',
			'email' => 'required|regex:/(.+)@(.+)/i|unique:users',
			'password' => 'required|min:8|max:50|confirmed',
		];
	}
    protected function failedValidation( Validator $validator): JsonResponse {

        $response = new JsonResponse([
            'status' => 'Invalid data',
            'errors' => $validator->errors()
        ], 400);
        throw new ValidationException($validator, $response);
    }
}
