<?php

namespace App\Http\Mappers;

use Cache;
use DB;

/**
 * Methods that call stored procedures and return arrays to controller methods
 *
 * @package  Mappers
 *
 * @author Steve Moore <stephenmoore56@msn.com>
 */

/**
 * ReportsApiMapper class
 *
 */
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

	/**
	 * List species and trips by year
	 * @access  public
	 * @return Array
	 */
	public static function speciesByYear() {
		$results = Cache::get(__METHOD__);
		if (!$results) {
			$results = DB::select('CALL proc_listSpeciesByYear();');
			Cache::forever(__METHOD__, $results);
		}
		return $results;
	}

	/**
	 * List species for month
	 * @access  public
	 * @param  monthNumber int
	 * @return Array
	 */
	public static function speciesForMonth($monthNumber) {
		$cacheKey = __METHOD__ . $monthNumber;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listSpeciesForMonth(?);', [$monthNumber]);
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List species for year
	 * @access  public
	 * @param  year int
	 * @return Array
	 */
	public static function speciesForYear($year) {
		$cacheKey = __METHOD__ . $year;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listSpeciesForYear(?);', [$year]);
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * Species detail
	 * @access  public
	 * @param  speciesId  int
	 *
	 * @return Array
	 */
	public static function speciesDetail($speciesId) {
		$cacheKey = __METHOD__ . $speciesId;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_getSpecies2(?);', [$speciesId]);
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List months for species
	 * @access  public
	 * @param  speciesId  int
	 * @return Array
	 */
	public static function monthsForSpecies($speciesId) {
		$cacheKey = __METHOD__ . $speciesId;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listMonthsForSpecies2(?);', [$speciesId]);
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List months for species
	 * @access  public
	 * @param  speciesId  int
	 * @return Array
	 */
	public static function sightingsByMonth($speciesId) {
		$cacheKey = __METHOD__ . $speciesId;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listMonthsForSpecies(?);', [$speciesId]);
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List species by order
	 * @access  public
	 * @return Array
	 */
	public static function speciesByOrder() {
		$results = Cache::get(__METHOD__);
		if (!$results) {
			$results = DB::select('CALL proc_listSpeciesByOrder();');
			Cache::forever(__METHOD__, $results);
		}
		return $results;
	}

	/**
	 * List species for order
	 * @access  public
	 * @param  orderId    int
	 * @return Array
	 */
	public static function speciesForOrder($orderId) {
		$cacheKey = __METHOD__ . $orderId;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listSpeciesForOrder(?);', [$orderId]);
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List all species
	 * @access  public
	 * @return Array
	 */
	public static function speciesAll() {
		$cacheKey = __METHOD__;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listSpeciesAll();');
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List orders
	 * @access  public
	 * @return Array
	 */
	public static function listOrders() {
		$cacheKey = __METHOD__;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listOrders();');
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List order ids
	 * @access  public
	 * @return Array
	 */
	public static function listOrderIds() {
		$cacheKey = __METHOD__;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listOrderIds();');
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List species ids
	 * @access  public
	 * @return Array
	 */
	public static function listSpeciesIds() {
		$cacheKey = __METHOD__;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listSpeciesIds();');
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List location ids
	 * @access  public
	 * @return Array
	 */
	public static function listLocationIds() {
		$cacheKey = __METHOD__;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listLocationIds();');
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List orders
	 * @access  public
	 * @return Array
	 */
	public static function listOrdersAll() {
		$cacheKey = __METHOD__;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listOrdersAll();');
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * search complete AOU list
	 * @access  public
	 * @param  searchString string
	 * @param  orderId      int
	 * @return Array
	 */
	public static function searchAll($searchString, $orderId) {
		$searchString = urldecode($searchString);
		$cacheKey = __METHOD__ . $searchString . $orderId;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_searchAll(?,?);', [$searchString, $orderId]);
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * List species and trips by location
	 * @access  public
	 * @return Array
	 */
	public static function speciesByLocation() {
		$results = Cache::get(__METHOD__);
		if (!$results) {
			$results = DB::select('CALL proc_listLocations2();');
			Cache::forever(__METHOD__, $results);
		}
		return $results;
	}

	/**
	 * List species and trips by county
	 * @access  public
	 * @return Array
	 */
	public static function speciesByCounty() {
		$results = Cache::get(__METHOD__);
		if (!$results) {
			$results = DB::select('CALL proc_listSpeciesByCounty();');
			Cache::forever(__METHOD__, $results);
		}
		return $results;
	}

	/**
	 * List species by month for ducks and warblers
	 * @access  public
	 * @return Array
	 */
	public static function twoSpeciesByMonth() {
		$results = Cache::get(__METHOD__);
		if (!$results) {
			$results = DB::select('CALL proc_listTwoSpeciesByMonth();');
			Cache::forever(__METHOD__, $results);
		}
		return $results;
	}

	/**
	 * Monthly average and record temperatures
	 * @access  public
	 * @return Array
	 */
	public static function monthlyTemps() {
		$results = Cache::get(__METHOD__);
		if (!$results) {
			$results = DB::select('CALL proc_listMonthlyAverages();');
			Cache::forever(__METHOD__, $results);
		}
		return $results;
	}

	/**
	 * List species for location
	 * @access  public
	 * @param  locationId int
	 * @return Array
	 */
	public static function speciesForLocation($locationId) {
		$cacheKey = __METHOD__ . $locationId;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_listSightingsForLocation2(?);', [$locationId]);
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

	/**
	 * Location detail
	 * @access  public
	 * @param  locationId int
	 * @return Array
	 */
	public static function locationDetail($locationId) {
		$cacheKey = __METHOD__ . $locationId;
		$results = Cache::get($cacheKey);
		if (!$results) {
			$results = DB::select('CALL proc_getLocation2(?);', [$locationId]);
			Cache::forever($cacheKey, $results);
		}
		return $results;
	}

}