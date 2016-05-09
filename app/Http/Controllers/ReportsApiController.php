<?php

namespace App\Http\Controllers;

use Cache;
use DB;
use Laravel\Lumen\Routing\Controller as BaseController;

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
class ReportsApiController extends BaseController
{
    /**
     * Clear memcached; mainly for testing
     * @access  public
     * @return Response
     */
    public static function clearCache()
    {
        try {
            Cache::flush();
            return response()->json([['message' => 'Cache flushed.']], 200, []);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List species and trips by month
     * @access  public
     * @return Response
     */
    public static function speciesByMonth()
    {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesByMonth();');
                Cache::forever(__METHOD__, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List species and trips by year
     * @access  public
     * @return Response
     */
    public static function speciesByYear()
    {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesByYear();');
                Cache::forever(__METHOD__, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List species for month
     * @access  public
     * @param  monthNumber int
     * @return Response
     */
    public static function speciesForMonth($monthNumber)
    {
        try {
            $cacheKey = __METHOD__ . $monthNumber;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesForMonth(?);', [$monthNumber]);
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * Species detail
     * @access  public
     * @param  speciesId  int
     * @return Response
     */
    public static function speciesDetail($speciesId)
    {
        try {
            $cacheKey = __METHOD__ . $speciesId;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_getSpecies2(?);', [$speciesId]);
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List months for species
     * @access  public
     * @param  speciesId  int
     * @return Response
     */
    public static function monthsForSpecies($speciesId)
    {
        try {
            $cacheKey = __METHOD__ . $speciesId;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listMonthsForSpecies2(?);', [$speciesId]);
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List species by order
     * @access  public
     * @return Response
     */
    public static function speciesByOrder()
    {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesByOrder();');
                Cache::forever(__METHOD__, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List species for order
     * @access  public
     * @param  orderId    int
     * @return Response
     */
    public static function speciesForOrder($orderId)
    {
        try {
            $cacheKey = __METHOD__ . $orderId;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesForOrder(?);', [$orderId]);
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List all species
     * @access  public
     * @return Response
     */
    public static function speciesAll()
    {
        try {
            $cacheKey = __METHOD__;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesAll();');
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List orders
     * @access  public
     * @return Response
     */
    public static function listOrders()
    {
        try {
            $cacheKey = __METHOD__;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listOrders();');
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List order ids
     * @access  public
     * @return Response
     */
    public static function listOrderIds()
    {
        try {
            $cacheKey = __METHOD__;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listOrderIds();');
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List species ids
     * @access  public
     * @return Response
     */
    public static function listSpeciesIds()
    {
        try {
            $cacheKey = __METHOD__;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesIds();');
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List location ids
     * @access  public
     * @return Response
     */
    public static function listLocationIds()
    {
        try {
            $cacheKey = __METHOD__;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listLocationIds();');
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List orders
     * @access  public
     * @return Response
     */
    public static function listOrdersAll()
    {
        try {
            $cacheKey = __METHOD__;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listOrdersAll();');
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * search complete AOU list
     * @access  public
     * @param  searchString string
     * @param  orderId      int
     * @return Response
     */
    public static function searchAll($searchString, $orderId)
    {
        try {
            $cacheKey = __METHOD__ . $searchString . $orderId;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_searchAll(?,?);', [$searchString, $orderId]);
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * lookup birds; for sightings
     * @access  public
     * @return Response
     */
    public static function birdLookup()
    {
        try {
            $query   = Input::get('query');
            $results = DB::select('CALL proc_birdLookup(?);', [$query]);
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List species and trips by location
     * @access  public
     * @return Response
     */
    public static function speciesByLocation()
    {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listLocations2();');
                Cache::forever(__METHOD__, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List species and trips by county
     * @access  public
     * @return Response
     */
    public static function speciesByCounty()
    {
        try {
            $results = Cache::get(__METHOD__);
            if (!$results) {
                $results = DB::select('CALL proc_listSpeciesByCounty();');
                Cache::forever(__METHOD__, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * List species for location
     * @access  public
     * @param  locationId int
     * @return Response
     */
    public static function speciesForLocation($locationId)
    {
        try {
            $cacheKey = __METHOD__ . $locationId;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_listSightingsForLocation2(?);', [$locationId]);
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

    /**
     * Location detail
     * @access  public
     * @param  locationId int
     * @return Response
     */
    public static function locationDetail($locationId)
    {
        try {
            $cacheKey = __METHOD__ . $locationId;
            $results  = Cache::get($cacheKey);
            if (!$results) {
                $results = DB::select('CALL proc_getLocation2(?);', [$locationId]);
                Cache::forever($cacheKey, $results);
            }
            return response()->json($results, 200, [], JSON_NUMERIC_CHECK);
        } catch (Exception $e) {
            return response()->json([['errors' => $e->getMessage()]], 500);
        }
    }

}
