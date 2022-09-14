<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsOrderDetail;

use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
 * Class AdsOrderDetailDetailController
 * @package App\Http\Controllers\AdsOrderDetail
 */
class AdsOrderDetailDetailController
{

    /**
     * @OA\Get(
     *      path="/api/ads-order-detail/{adsOrderDetailId}/detail",
     *      tags={"Ads Order Detail"},
     *      summary="Get Ads Order Detail Detail",
     *      description="Returns Ads Order Detail Detail",
     *      @OA\Parameter(
     *          name="adsOrderDetailId",
     *          description="Ads Order Detail adsOrderDetailId",
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
     * Returns Ads Order Detail Detail
     */
    public function __invoke(int $adsOrderDetailId,
                             AdsOrderDetailService $adsOrderDetailService,
                             AdsOrderDetailResponse $adsOrderDetailResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$adsOrderDetailService, 'getByAdsOrderDetailId'], compact('adsOrderDetailId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->adsOrderDetail, $adsOrderDetailResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
