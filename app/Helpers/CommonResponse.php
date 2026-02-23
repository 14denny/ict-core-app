<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

trait CommonResponse
{
  protected function resSuccess($data, string $message = '', int $code = 200): JsonResponse
  {
    return response()->json([
      'status' => true,
      'msg' => $message,
      'data' => $data,
      'csrf_token' => csrf_token()
    ], $code);
  }

  protected function resError(string $message = '', int $code = 200): JsonResponse
  {
    return response()->json([
      'status' => false,
      'msg' => $message,
      'csrf_token' => csrf_token()
    ], $code);
  }

  protected function apiSuccess($data, string $message = '', int $code = 200): JsonResponse
  {
    return response()->json([
      'status' => true,
      'msg' => $message,
      'data' => $data,
    ], $code);
  }

  protected function apiError(string $message = '', int $code = 200): JsonResponse
  {
    return response()->json([
      'status' => false,
      'msg' => $message,
    ], $code);
  }
}
