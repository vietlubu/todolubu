<?php

namespace App\Controllers;

class JsonController
{
    /**
     * Construct function.
     */
    public function __construct()
    {
        header('Content-Type: application/json');
    }

    /**
     * Response success json
     *
     * @param string $message Message
     *
     * @return json
     */
    protected function successResponse($message = "Success")
    {
        echo json_encode(["status" => "success", "message" => $message]);
    }

    /**
     * Response failed json
     *
     * @param string $message Message
     *
     * @return json
     */
    protected function failedResponse($message = "Failed")
    {
        echo json_encode(["status" => "failed", "message" => $message]);
    }
}
