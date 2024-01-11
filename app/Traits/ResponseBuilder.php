<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ResponseBuilder
{
    public function createResponse(bool $isSuccess, string $message, $result, int $responseCode): Response {
        $data = [
            'rc' => $responseCode,
            'success' => $isSuccess,
            'message' => $message,
            'result' => $result,
        ];
        return response()->json($data, $responseCode);
    }
}
