<?php

namespace App\Http\Mappers;

use Cache;
use DB;

class ReportsApiMapper {

	/**
	 * Clear memcached; mainly for testing
	 * @access public
	 */
	public static function clearCache() {
		Cache::flush();
	}

	/**
	 * List species and trips by month
	 * @access  public
	 * @return
	 */
	public static function speciesByMonth() {

		$results = Cache::get(__METHOD__);
		if (!$results) {
			$results = DB::select('CALL proc_listSpeciesByMonth();');
			Cache::forever(__METHOD__, $results);
		}
		return $results;

	}

}