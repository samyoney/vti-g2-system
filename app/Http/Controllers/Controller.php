<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Returns the current user
     */
    protected function getCurrentUser(): User|Authenticatable|null
    {
        return Auth::check() ? Auth::user() : null;
    }

    /**
     * Send data response
     */
    protected function responseDataSuccess(array $data): JsonResponse
    {
        return $this->responseSuccess('', $data);
    }

    /**
     * Send a successful response
     */
    protected function responseDeleteSuccess($data = [], $code = 200): JsonResponse
    {
        return $this->responseSuccess(trans('frontend.global.phrases.record_deleted'), $data, $code);
    }

    /**
     * Send a failed response
     */
    protected function responseDeleteFail(array $data = [], int $code = 422): JsonResponse
    {
        return $this->responseFail(trans('frontend.global.phrases.record_not_deleted'), $data, $code);
    }

    /**
     * Send a successful response
     */
    protected function responseUpdateSuccess($data = [], $code = 200): JsonResponse
    {
        return $this->responseSuccess(trans('frontend.global.phrases.record_updated'), $data, $code);
    }

    /**
     * Send a failed response
     */
    protected function responseUpdateFail(array $data = [], int $code = 422): JsonResponse
    {
        return $this->responseFail(trans('frontend.global.phrases.record_not_updated'), $data, $code);
    }

    /**
     * Send a successful response
     */
    protected function responseStoreSuccess($data = [], $code = 200): JsonResponse
    {
        return $this->responseSuccess(trans('frontend.global.phrases.record_created'), $data, $code);
    }

    /**
     * Send a failed response
     */
    protected function responseStoreFail(array $data = [], int $code = 422): JsonResponse
    {
        return $this->responseFail(trans('frontend.global.phrases.record_not_created'), $data, $code);
    }

    /**
     * Send a successful response
     */
    protected function responseSuccess(string $message, array $data = [], int $code = 200): JsonResponse
    {
        return $this->response($code, $message, $data);
    }

    /**
     * Send a failed response
     */
    protected function responseFail(string $message, array $data = [], int $code = 400): JsonResponse
    {
        return $this->response($code, $message, $data);
    }

    /**
     * Returns a response
     */
    protected function response(int $code, string $message = '', array $data = []): JsonResponse
    {
        return response()->json(array_merge(['message' => $message], $data), $code);
    }
}
