<?php

namespace App\Http\Controllers;

use Cache;
use DB;
use Symfony\Component\HttpFoundation\Response as Response;
use \Exception as Exception;

/**
 * Methods that serve JSON data for reports
 *
 * @package  Controllers
 *
 * @author Steve Moore <stephenmoore56@msn.com>
 */

/**
 * ReportsApiController class
 *
 */
class ReportsApiController extends Controller {
    // messages for HTTP error status codes
    const HTTP_NOT_FOUND_MESSAGE = "Not Found";
    const HTTP_BAD_REQUEST_MESSAGE = "Bad Request";

    /**
     * Clear memcached; mainly for testing
     * @access  public
     * @return Response
     */
    public static function clearCache() {
        try {
            Cache::flush();
            return response()->json(['data' => ['message' => 'Cache flushed.']], Response::HTTP_OK, []);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species and trips by month
     * @access  public
     * @return Response
     */
    public static function speciesByMonth() {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesByMonth();');
                Cache::forever(__METHOD__, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species and trips by year
     * @access  public
     * @return Response
     */
    public static function speciesByYear() {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesByYear();');
                Cache::forever(__METHOD__, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species for month
     * @access  public
     * @param  monthNumber int
     * @return Response
     */
    public static function speciesForMonth($monthNumber) {
        try {
            $cacheKey = __METHOD__ . $monthNumber;
            $results = Cache::get($cacheKey);
            if (!$results) {
                if ($monthNumber > 12 || $monthNumber < 1) {
                    return self::formatErrorResponse(Response::HTTP_BAD_REQUEST, self::HTTP_BAD_REQUEST_MESSAGE);
                }
                $results = DB::select('CALL proc_listSpeciesForMonth(?);', [$monthNumber]);
                if (!count($results)) {
                    return self::formatErrorResponse(Response::HTTP_NOT_FOUND, self::HTTP_NOT_FOUND_MESSAGE);
                }
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species for year
     * @access  public
     * @param  year int
     * @return Response
     */
    public static function speciesForYear($year) {
        try {
            $cacheKey = __METHOD__ . $year;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesForYear(?);', [$year]);
                if (!count($results)) {
                    return self::formatErrorResponse(Response::HTTP_NOT_FOUND, self::HTTP_NOT_FOUND_MESSAGE);
                }
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }


    /**
     * Species detail
     * @access  public
     * @param  speciesId  int
     *
     * @return Response
     */
    public function speciesDetail($speciesId) {
        try {
            $cacheKey = __METHOD__ . $speciesId;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_getSpecies2(?);', [$speciesId]);
                if (!count($results)) {
                    return self::formatErrorResponse(Response::HTTP_NOT_FOUND, self::HTTP_NOT_FOUND_MESSAGE);
                }
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List months for species
     * @access  public
     * @param  speciesId  int
     * @return Response
     */
    public function monthsForSpecies($speciesId) {
        try {
            $cacheKey = __METHOD__ . $speciesId;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listMonthsForSpecies2(?);', [$speciesId]);
                if ($results[0]->common_name == '') {
                    return self::formatErrorResponse(Response::HTTP_NOT_FOUND, self::HTTP_NOT_FOUND_MESSAGE);
                }
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List months for species
     * @access  public
     * @param  speciesId  int
     * @return Response
     */
    public function sightingsByMonth($speciesId) {
        try {
            $cacheKey = __METHOD__ . $speciesId;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listMonthsForSpecies(?);', [$speciesId]);
                if (!count($results)) {
                    return self::formatErrorResponse(Response::HTTP_NOT_FOUND, self::HTTP_NOT_FOUND_MESSAGE);
                }
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species by order
     * @access  public
     * @return Response
     */
    public function speciesByOrder() {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesByOrder();');
                Cache::forever(__METHOD__, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species for order
     * @access  public
     * @param  orderId    int
     * @return Response
     */
    public function speciesForOrder($orderId) {
        try {
            $cacheKey = __METHOD__ . $orderId;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesForOrder(?);', [$orderId]);
                if (!count($results)) {
                    return self::formatErrorResponse(Response::HTTP_NOT_FOUND, self::HTTP_NOT_FOUND_MESSAGE);
                }
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List all species
     * @access  public
     * @return Response
     */
    public function speciesAll() {
        try {
            $cacheKey = __METHOD__;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesAll();');
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List orders
     * @access  public
     * @return Response
     */
    public function listOrders() {
        try {
            $cacheKey = __METHOD__;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listOrders();');
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List order ids
     * @access  public
     * @return Response
     */
    public function listOrderIds() {
        try {
            $cacheKey = __METHOD__;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listOrderIds();');
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species ids
     * @access  public
     * @return Response
     */
    public function listSpeciesIds() {
        try {
            $cacheKey = __METHOD__;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesIds();');
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List location ids
     * @access  public
     * @return Response
     */
    public function listLocationIds() {
        try {
            $cacheKey = __METHOD__;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listLocationIds();');
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List orders
     * @access  public
     * @return Response
     */
    public function listOrdersAll() {
        try {
            $cacheKey = __METHOD__;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listOrdersAll();');
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * search complete AOU list
     * @access  public
     * @param  searchString string
     * @param  orderId      int
     * @return Response
     */
    public function searchAll($searchString, $orderId) {
        try {
            $searchString = urldecode($searchString);
            $cacheKey = __METHOD__ . $searchString . $orderId;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_searchAll(?,?);', [$searchString, $orderId]);
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species and trips by location
     * @access  public
     * @return Response
     */
    public function speciesByLocation() {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listLocations2();');
                Cache::forever(__METHOD__, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species and trips by county
     * @access  public
     * @return Response
     */
    public function speciesByCounty() {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesByCounty();');
                Cache::forever(__METHOD__, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species by month for ducks and warblers
     * @access  public
     * @return Response
     */
    public function twoSpeciesByMonth() {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listTwoSpeciesByMonth();');
                Cache::forever(__METHOD__, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * Monthly average and record temperatures
     * @access  public
     * @return Response
     */
    public function monthlyTemps() {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listMonthlyAverages();');
                Cache::forever(__METHOD__, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * List species for location
     * @access  public
     * @param  locationId int
     * @return Response
     */
    public function speciesForLocation($locationId) {
        try {
            $cacheKey = __METHOD__ . $locationId;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSightingsForLocation2(?);', [$locationId]);
                if (!count($results)) {
                    return self::formatErrorResponse(Response::HTTP_NOT_FOUND, self::HTTP_NOT_FOUND_MESSAGE);
                }
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * Location detail
     * @access  public
     * @param  locationId int
     * @return Response
     */
    public function locationDetail($locationId) {
        try {
            $cacheKey = __METHOD__ . $locationId;
            $results = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_getLocation2(?);', [$locationId]);
                if (!count($results)) {
                    return self::formatErrorResponse(Response::HTTP_NOT_FOUND, self::HTTP_NOT_FOUND_MESSAGE);
                }
                Cache::forever($cacheKey, $results);
            }
            return self::formatNormalResponse(Response::HTTP_OK, $results);
        } catch (Exception $e) {
            return self::formatErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

}
