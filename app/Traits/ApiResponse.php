<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data = null, $message = null, $statusCode = 200)
    {
        $response = ['success' => true];
        
        if ($message) {
            $response['message'] = $message;
        }
        
        if ($data !== null) {
            $response['data'] = $data;
        }
        
        return response()->json($response, $statusCode);
    }

    protected function errorResponse($message, $errors = null, $statusCode = 400)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        
        if ($errors) {
            $response['errors'] = $errors;
        }
        
        return response()->json($response, $statusCode);
    }
}

