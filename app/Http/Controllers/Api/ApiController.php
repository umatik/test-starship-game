<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiController
 * @package App\Http\Controllers\Api
 */
abstract class ApiController extends Controller
{

    /**
     * @param $body
     * @return JsonResponse
     */
    protected function success($body)
    {
        return $this->send('success', $body, 200);
    }

    /**
     * @param $status
     * @param $body
     * @param $httpCode
     * @return JsonResponse
     */
    private function send($status, $body, $httpCode)
    {
        if (is_object($body) and class_implements($body, Arrayable::class)) {
            /** @var Arrayable $body */
            $body = $body->toArray();
        }

        return response()->json(array(
            'status' => $status,
            'data' => $body
        ))->setStatusCode($httpCode);
    }

    /**
     * @return JsonResponse
     */
    protected function created($body)
    {
        return $this->send('created', $body, 201);
    }

    /**
     * @param $body
     * @return JsonResponse
     */
    protected function badRequest($body)
    {
        return $this->send('bad_request', $body, 400);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function unauthorized($body = null)
    {
        if (is_null($body)) {
            $body = "You are unauthorized to make this request.";
        }
        return $this->send('unauthorized', $body, 401);
    }

    /**
     * @param null $body
     */
    protected function forbidden($body = null)
    {
        if (is_null($body)) {
            $body = "Forbidden";
        }
        $this->send('forbidden', $body, 403);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function notFound($body = null)
    {
        if (is_null($body)) {
            $body = "Unable to find requested content.";
        }
        return $this->send('not_found', $body, 404);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function error($body = null)
    {
        if (is_null($body)) {
            $body = "There was an internal server error.";
        }
        return $this->send('internal_server_error', $body, 500);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function accepted($body = null)
    {
        if (is_null($body)) {
            $body = "The request has been accepted and will processed shortly.";
        }
        return $this->send('accepted', $body, 202);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function deleted($body = null)
    {
        if (is_null($body)) {
            $body = "The entity has been deleted.";
        }
        return $this->send('deleted', $body, 200);
    }
}
