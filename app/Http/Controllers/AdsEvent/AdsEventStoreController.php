<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AdsEvent;

use App\Requests\AdsEventRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
 * Class AdsEventStoreController
 * @package App\Http\Controllers\AdsEvent
 */
class AdsEventStoreController
{
/**
     * @OA\Post(
     *      path="/api/ads-event/store",
     *      tags={"Ads Event"},
     *      summary="Store Ads Event Data",
     *      description="Store Ads Event Data",
     *      @OA\Parameter(
     *          name="adsEventEventId",
     *          in="query",
     *          required=true,
     *          description="AdsEvent adsEventEventId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsEventAdsOrderId",
     *          in="query",
     *          required=true,
     *          description="AdsEvent adsEventAdsOrderId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsEventHitNumber",
     *          in="query",
     *          required=true,
     *          description="AdsEvent adsEventHitNumber",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsEventDateChange",
     *          in="query",
     *          required=true,
     *          description="AdsEvent adsEventDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsEventUserId",
     *          in="query",
     *          required=true,
     *          description="AdsEvent adsEventUserId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=201,
     *          description="Store Data Success"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="System error"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns Ads Event Store status
     */
    public function __invoke(AdsEventRequest $adsEventRequest,
                             AdsEventServiceRequest $adsEventServiceRequest,
                             AdsEventService $adsEventService,
                             AdsEventResponse $adsEventResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $adsEventValidated = $adsEventRequest->validated();

        $adsEventServiceRequest = Lazy::copyFromArray($adsEventValidated, $adsEventServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$adsEventService, 'store'], ['adsEventServiceRequest' => $adsEventServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-event.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->adsEvent, $adsEventResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-event.create', request()->query->all()));
            }
            return $smartResponse->saveDataFailed($response);
        }
    }
}
