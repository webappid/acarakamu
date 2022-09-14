<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsOrder;

use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
 * Class AdsOrderDetailController
 * @package App\Http\Controllers\AdsOrder
 */
class AdsOrderDetailController
{

    /**
     * @OA\Get(
     *      path="/api/ads-order/{adsOrderId}/detail",
     *      tags={"Ads Order"},
     *      summary="Get Ads Order Detail",
     *      description="Returns Ads Order Detail",
     *      @OA\Parameter(
     *          name="adsOrderId",
     *          description="Ads Order adsOrderId",
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
     * Returns Ads Order Detail
     */
    public function __invoke(int $adsOrderId,
                             AdsOrderService $adsOrderService,
                             AdsOrderResponse $adsOrderResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$adsOrderService, 'getByAdsOrderId'], compact('adsOrderId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->adsOrder, $adsOrderResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
