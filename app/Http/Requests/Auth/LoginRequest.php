<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
{
	protected $model = 'user';

	public function rules(): array
	{
		return [
			'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
			'password' => 'required|min:8|max:50',
		];
	}
    protected function failedValidation( Validator $validator): JsonResponse {

        $response = new JsonResponse([
            'status' => 'invalid data',
            'errors' => $validator->errors()
        ], 400);
        throw new ValidationException($validator, $response);
    }
}
