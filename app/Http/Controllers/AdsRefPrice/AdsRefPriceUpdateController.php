<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsRefPrice;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
 * Class AdsRefPriceUpdateController
 * @package App\Http\Controllers\AdsRefPrice
 */
class AdsRefPriceUpdateController
{
/**
     * @OA\Put(
     *      path="/api/ads-ref-price/{adsPriceRefId}/update",
     *      tags={"Ads Ref Price"},
     *      summary="Store Ads Ref Price Data",
     *      description="Store Ads Ref Price Data",
     *      @OA\Parameter(
     *          name="adsPriceRefId",
     *          description="Ads Ref Price adsPriceRefId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsPriceRefCode",
     *          in="query",
     *          required=true,
     *          description="AdsRefPrice adsPriceRefCode",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsPriceRefValue",
     *          in="query",
     *          required=true,
     *          description="AdsRefPrice adsPriceRefValue",
     *          @OA\Schema(
     *              type="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsPriceRefClick",
     *          in="query",
     *          required=true,
     *          description="AdsRefPrice adsPriceRefClick",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsPriceRefDateChange",
     *          in="query",
     *          required=true,
     *          description="AdsRefPrice adsPriceRefDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsPriceRefUserId",
     *          in="query",
     *          required=true,
     *          description="AdsRefPrice adsPriceRefUserId",
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
     * Returns Ads Ref Price Update status
     */

    public function __invoke(int $adsPriceRefId,
                             AdsRefPriceRequest $adsRefPriceRequest,
                             AdsRefPriceServiceRequest $adsRefPriceServiceRequest,
                             AdsRefPriceService $adsRefPriceService,
                             AdsRefPriceResponse $adsRefPriceResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $adsRefPriceValidated = $adsRefPriceRequest->validated();

        $adsRefPriceServiceRequest = Lazy::copyFromArray($adsRefPriceValidated, $adsRefPriceServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$adsRefPriceService, 'update'], ['adsPriceRefId' => $adsPriceRefId, 'adsRefPriceServiceRequest' => $adsRefPriceServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-ref-price.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->adsRefPrice, $adsRefPriceResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-ref-price.edit', array_merge(['adsPriceRefId' => $adsPriceRefId], request()->query->all())));
            }
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
