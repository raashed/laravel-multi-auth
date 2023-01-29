<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    public function successApiResponse($data): JsonResponse
    {
        return response()->json([
            'message' => 'Success',
            'data' => $data
        ]);
    }

    public function validationErrorApiResponse($data): JsonResponse
    {
        return response()->json([
            'message' => 'Validation_Error',
            'data' => $data
        ], 403);
    }

    public function unAuthenticatedApiResponse(): JsonResponse
    {
        return response()->json([
            'message' => 'UnAuthenticated',
            'data' => 'Invalid token or token expired.'
        ], 401);
    }
}
