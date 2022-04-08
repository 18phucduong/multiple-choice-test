<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponser
{
	public function successResponse(array $data, string $status = 'Success',  int $code = Response::HTTP_OK): JsonResponse
	{
        $response = [
            'status' => $status,
		];
        $finalResponse = array_merge($response, $data);
		return response()->json($finalResponse, $code);
	}

	public function errorValidation(array $data,string $status = 'Invalid data', int $code): JsonResponse
	{
		return response()->json([
            'status' => $status,
			'errors' => $data
		], $code);
	}
}
