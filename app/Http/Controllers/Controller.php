<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {
    /**
     * Format errors response
     * @param $status
     * @param $title
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected static function formatErrorResponse($status, $title) {
        return response()->json(['errors' => ['status' => (string)$status, 'title' => $title]], $status);
    }

    /**
     * Format normal data response
     * @param $results
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected static function formatNormalResponse($status, $results) {
        return response()->json(['data' => $results], $status, [], JSON_NUMERIC_CHECK);
    }
}
