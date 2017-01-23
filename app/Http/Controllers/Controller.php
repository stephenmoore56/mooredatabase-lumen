<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {
	/**
	 * Format errors response
	 * @param int $status
	 * @param string $title
	 * @return \Illuminate\Contracts\Routing\ResponseFactory
	 */
	protected static function formatErrorResponse(int $status, string $title) {
		return response()->json(['errors' => ['status' => (string)$status, 'title' => $title]], $status);
	}

	/**
	 * Format normal data response
	 * @return \Illuminate\Contracts\Routing\ResponseFactory
	 * @param int $status
	 * @param array $results
	 */
	protected static function formatNormalResponse(int $status, array $results) {
		return response()->json(['data' => $results], $status, [], JSON_NUMERIC_CHECK);
	}
}
