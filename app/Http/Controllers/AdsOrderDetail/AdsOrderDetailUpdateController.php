<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsOrderDetail;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
 * Class AdsOrderDetailUpdateController
 * @package App\Http\Controllers\AdsOrderDetail
 */
class AdsOrderDetailUpdateController
{
/**
     * @OA\Put(
     *      path="/api/ads-order-detail/{adsOrderDetailId}/update",
     *      tags={"Ads Order Detail"},
     *      summary="Store Ads Order Detail Data",
     *      description="Store Ads Order Detail Data",
     *      @OA\Parameter(
     *          name="adsOrderDetailId",
     *          description="Ads Order Detail adsOrderDetailId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderDetailAdsOrderId",
     *          in="query",
     *          required=true,
     *          description="AdsOrderDetail adsOrderDetailAdsOrderId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderDetailAdsRefPriceId",
     *          in="query",
     *          required=true,
     *          description="AdsOrderDetail adsOrderDetailAdsRefPriceId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderDetailAdsEventId",
     *          in="query",
     *          required=true,
     *          description="AdsOrderDetail adsOrderDetailAdsEventId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderDetailQty",
     *          in="query",
     *          required=true,
     *          description="AdsOrderDetail adsOrderDetailQty",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderDetailSubTotal",
     *          in="query",
     *          required=true,
     *          description="AdsOrderDetail adsOrderDetailSubTotal",
     *          @OA\Schema(
     *              type="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderDetailTotal",
     *          in="query",
     *          required=true,
     *          description="AdsOrderDetail adsOrderDetailTotal",
     *          @OA\Schema(
     *              type="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderDetailDateChange",
     *          in="query",
     *          required=true,
     *          description="AdsOrderDetail adsOrderDetailDateChange",
     *          @OA\Schema(
     *              type="string"
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
     * Returns Ads Order Detail Update status
     */

    public function __invoke(int $adsOrderDetailId,
                             AdsOrderDetailRequest $adsOrderDetailRequest,
                             AdsOrderDetailServiceRequest $adsOrderDetailServiceRequest,
                             AdsOrderDetailService $adsOrderDetailService,
                             AdsOrderDetailResponse $adsOrderDetailResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $adsOrderDetailValidated = $adsOrderDetailRequest->validated();

        $adsOrderDetailServiceRequest = Lazy::copyFromArray($adsOrderDetailValidated, $adsOrderDetailServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$adsOrderDetailService, 'update'], ['adsOrderDetailId' => $adsOrderDetailId, 'adsOrderDetailServiceRequest' => $adsOrderDetailServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-order-detail.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->adsOrderDetail, $adsOrderDetailResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-order-detail.edit', array_merge(['adsOrderDetailId' => $adsOrderDetailId], request()->query->all())));
            }
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
