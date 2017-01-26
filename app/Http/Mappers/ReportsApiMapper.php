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
		/** @noinspection PhpUndefinedMethodInspection */
		Cache::flush();
	}

	/**
	 * List species and trips by month
	 * @access  public
	 * @return array
	 */
	public static function speciesByMonth(): array {
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSpeciesByMonth();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSpeciesByYear();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get($cacheKey, function () use ($cacheKey, $monthNumber) {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSpeciesForMonth(?);', [$monthNumber]);
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get($cacheKey, function () use ($cacheKey, $year) {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSpeciesForYear(?);', [$year]);
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get($cacheKey, function () use ($cacheKey, $speciesId) {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_getSpecies2(?);', [$speciesId]);
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get($cacheKey, function () use ($cacheKey, $speciesId) {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listMonthsForSpecies2(?);', [$speciesId]);
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get($cacheKey, function () use ($cacheKey, $speciesId) {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listMonthsForSpecies(?);', [$speciesId]);
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSpeciesByOrder();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get($cacheKey, function () use ($cacheKey, $orderId) {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSpeciesForOrder(?);', [$orderId]);
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSpeciesAll();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listOrders();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listOrderIds();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSpeciesIds();');
			/** @noinspection PhpUndefinedMethodInspection */
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
	public static function listLocationIds(): array {
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listLocationIds();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listOrdersAll();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get($cacheKey, function () use ($cacheKey, $searchString, $orderId) {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_searchAll(?,?);', [$searchString, $orderId]);
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listLocations2();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSpeciesByCounty();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listTwoSpeciesByMonth();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get(__METHOD__, function () {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listMonthlyAverages();');
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get($cacheKey, function () use ($cacheKey, $locationId) {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_listSightingsForLocation2(?);', [$locationId]);
			/** @noinspection PhpUndefinedMethodInspection */
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
		/** @noinspection PhpUndefinedMethodInspection */
		$results = Cache::get($cacheKey, function () use ($cacheKey, $locationId) {
			/** @noinspection PhpUndefinedMethodInspection */
			$results = DB::select('CALL proc_getLocation2(?);', [$locationId]);
			/** @noinspection PhpUndefinedMethodInspection */
			Cache::forever($cacheKey, $results);
			return $results;
		});
		return $results;
	}

}