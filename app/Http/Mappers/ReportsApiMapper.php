<?php
declare(strict_types = 1);

namespace App\Http\Mappers;

use \Illuminate\Support\Facades\Cache;
use \Illuminate\Support\Facades\DB;

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
	 * @return array
	 */
	public static function speciesByMonth(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listSpeciesByMonth();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species and trips by year
	 * @access  public
	 * @return array
	 */
	public static function speciesByYear(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listSpeciesByYear();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species for month
	 * @access  public
	 * @param int $monthNumber
	 * @return array
	 */
	public static function speciesForMonth(int $monthNumber): array {
		$cacheKey = __METHOD__ . $monthNumber;
		$results = Cache::get($cacheKey, function () use ($cacheKey, $monthNumber) {
			$results = DB::select('CALL proc_listSpeciesForMonth(?);', [$monthNumber]);
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species for year
	 * @access  public
	 * @param int $year
	 * @return array
	 */
	public static function speciesForYear(int $year): array {
		$cacheKey = __METHOD__ . $year;
		$results = Cache::get($cacheKey, function () use ($cacheKey, $year) {
			$results = DB::select('CALL proc_listSpeciesForYear(?);', [$year]);
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * Species detail
	 * @access  public
	 * @param int $speciesId
	 * @return array
	 */
	public static function speciesDetail(int $speciesId): array {
		$cacheKey = __METHOD__ . $speciesId;
		$results = Cache::get($cacheKey, function () use ($cacheKey, $speciesId) {
			$results = DB::select('CALL proc_getSpecies2(?);', [$speciesId]);
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List months for species
	 * @access  public
	 * @param int $speciesId
	 * @return array
	 */
	public static function monthsForSpecies(int $speciesId): array {
		$cacheKey = __METHOD__ . $speciesId;
		$results = Cache::get($cacheKey, function () use ($cacheKey, $speciesId) {
			$results = DB::select('CALL proc_listMonthsForSpecies2(?);', [$speciesId]);
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List months for species
	 * @access  public
	 * @param int $speciesId
	 * @return array
	 */
	public static function sightingsByMonth(int $speciesId): array {
		$cacheKey = __METHOD__ . $speciesId;
		$results = Cache::get($cacheKey, function () use ($cacheKey, $speciesId) {
			$results = DB::select('CALL proc_listMonthsForSpecies(?);', [$speciesId]);
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species by order
	 * @access  public
	 * @return array
	 */
	public static function speciesByOrder(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listSpeciesByOrder();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species for order
	 * @access  public
	 * @param int $orderId
	 * @return array
	 */
	public static function speciesForOrder(int $orderId): array {
		$cacheKey = __METHOD__ . $orderId;
		$results = Cache::get($cacheKey, function () use ($cacheKey, $orderId) {
			$results = DB::select('CALL proc_listSpeciesForOrder(?);', [$orderId]);
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List all species
	 * @access  public
	 * @return array
	 */
	public static function speciesAll(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listSpeciesAll();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List orders
	 * @access  public
	 * @return array
	 */
	public static function listOrders(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listOrders();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List order ids
	 * @access  public
	 * @return array
	 */
	public static function listOrderIds(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listOrderIds();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species ids
	 * @access  public
	 * @return array
	 */
	public static function listSpeciesIds(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listSpeciesIds();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List location ids
	 * @access  public
	 * @return array
	 */
	public static function listLocationIds() {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listLocationIds();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List orders
	 * @access  public
	 * @return array
	 */
	public static function listOrdersAll(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listOrdersAll();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * search complete AOU list
	 * @access  public
	 * @param string $searchString
	 * @param int $orderId
	 * @return array
	 */
	public static function searchAll(string $searchString, int $orderId): array {
		$searchString = urldecode($searchString);
		$cacheKey = __METHOD__ . $searchString . $orderId;
		$results = Cache::get($cacheKey, function () use ($cacheKey, $searchString, $orderId) {
			$results = DB::select('CALL proc_searchAll(?,?);', [$searchString, $orderId]);
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species and trips by location
	 * @access  public
	 * @return array
	 */
	public static function speciesByLocation(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listLocations2();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species and trips by county
	 * @access  public
	 * @return array
	 */
	public static function speciesByCounty(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listSpeciesByCounty();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species by month for ducks and warblers
	 * @access  public
	 * @return array
	 */
	public static function twoSpeciesByMonth(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listTwoSpeciesByMonth();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * Monthly average and record temperatures
	 * @access  public
	 * @return array
	 */
	public static function monthlyTemps(): array {
		$results = Cache::get(__METHOD__, function () {
			$results = DB::select('CALL proc_listMonthlyAverages();');
			Cache::forever(__METHOD__, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * List species for location
	 * @access  public
	 * @param int $locationId
	 * @return array
	 */
	public static function speciesForLocation(int $locationId): array {
		$cacheKey = __METHOD__ . $locationId;
		$results = Cache::get($cacheKey, function () use ($cacheKey, $locationId) {
			$results = DB::select('CALL proc_listSightingsForLocation2(?);', [$locationId]);
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

	/**
	 * Location detail
	 * @access  public
	 * @param int $locationId
	 * @return array
	 */
	public static function locationDetail(int $locationId): array {
		$cacheKey = __METHOD__ . $locationId;
		$results = Cache::get($cacheKey, function () use ($cacheKey, $locationId) {
			$results = DB::select('CALL proc_getLocation2(?);', [$locationId]);
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

}