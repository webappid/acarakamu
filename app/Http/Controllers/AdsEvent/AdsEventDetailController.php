<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsEvent;

use App\Responses\AdsEventResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
 * Class AdsEventDetailController
 * @package App\Http\Controllers\AdsEvent
 */
class AdsEventDetailController
{

    /**
     * @OA\Get(
     *      path="/api/ads-event/{adsEventId}/detail",
     *      tags={"Ads Event"},
     *      summary="Get Ads Event Detail",
     *      description="Returns Ads Event Detail",
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
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns Ads Event Detail
     */
    public function __invoke(int $adsEventId,
                             AdsEventService $adsEventService,
                             AdsEventResponse $adsEventResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$adsEventService, 'getByAdsEventId'], compact('adsEventId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->adsEvent, $adsEventResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
