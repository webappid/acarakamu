<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsRefPrice;

use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
 * Class AdsRefPriceDetailController
 * @package App\Http\Controllers\AdsRefPrice
 */
class AdsRefPriceDetailController
{

    /**
     * @OA\Get(
     *      path="/api/ads-ref-price/{adsPriceRefId}/detail",
     *      tags={"Ads Ref Price"},
     *      summary="Get Ads Ref Price Detail",
     *      description="Returns Ads Ref Price Detail",
     *      @OA\Parameter(
     *          name="adsPriceRefId",
     *          description="Ads Ref Price adsPriceRefId",
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
     * Returns Ads Ref Price Detail
     */
    public function __invoke(int $adsPriceRefId,
                             AdsRefPriceService $adsRefPriceService,
                             AdsRefPriceResponse $adsRefPriceResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$adsRefPriceService, 'getByAdsPriceRefId'], compact('adsPriceRefId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->adsRefPrice, $adsRefPriceResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
