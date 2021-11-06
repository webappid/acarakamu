<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AdsEvent;

use App\Services\AdsEventService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:54
 * Time: 2021/11/06
 * Class AdsEventDeleteController
 * @package App\Http\Controllers\AdsEvent
 */
class AdsEventDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/ads-event/{adsEventId}/delete",
     *      tags={"Ads Event"},
     *      summary="Get Ads Event List",
     *      description="Returns Ads Event List",
     *      @OA\Parameter(
     *          name="adsEventId",
     *          description="Ads Event adsEventId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=200,
     *          description="Get Data Success"
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns Ads Event List
     */
    /**
     * @param int $adsEventId
     * @param AdsEventService $adsEventService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $adsEventId,
                             AdsEventService $adsEventService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$adsEventService, 'delete'], compact('adsEventId'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
