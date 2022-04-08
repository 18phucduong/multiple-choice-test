<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function failedValidation( Validator $validator): JsonResponse {

        $response = new JsonResponse([
            'status' => 'Invalid data',
            'errors' => $validator->errors()
        ], 400);
        throw new ValidationException($validator, $response);
    }
}
