<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AdsOrder;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
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
 * Class AdsOrderStoreController
 * @package App\Http\Controllers\AdsOrder
 */
class AdsOrderStoreController
{
/**
     * @OA\Post(
     *      path="/api/ads-order/store",
     *      tags={"Ads Order"},
     *      summary="Store Ads Order Data",
     *      description="Store Ads Order Data",
     *      @OA\Parameter(
     *          name="adsOrderNumber",
     *          in="query",
     *          required=true,
     *          description="AdsOrder adsOrderNumber",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderDateOrder",
     *          in="query",
     *          required=true,
     *          description="AdsOrder adsOrderDateOrder",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderStatusId",
     *          in="query",
     *          required=true,
     *          description="AdsOrder adsOrderStatusId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderDateChange",
     *          in="query",
     *          required=false,
     *          description="AdsOrder adsOrderDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderQty",
     *          in="query",
     *          required=true,
     *          description="AdsOrder adsOrderQty",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderTotal",
     *          in="query",
     *          required=true,
     *          description="AdsOrder adsOrderTotal",
     *          @OA\Schema(
     *              type="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adsOrderUserId",
     *          in="query",
     *          required=true,
     *          description="AdsOrder adsOrderUserId",
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
     * Returns Ads Order Store status
     */
    public function __invoke(AdsOrderRequest $adsOrderRequest,
                             AdsOrderServiceRequest $adsOrderServiceRequest,
                             AdsOrderService $adsOrderService,
                             AdsOrderResponse $adsOrderResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $adsOrderValidated = $adsOrderRequest->validated();

        $adsOrderServiceRequest = Lazy::copyFromArray($adsOrderValidated, $adsOrderServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$adsOrderService, 'store'], ['adsOrderServiceRequest' => $adsOrderServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-order.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->adsOrder, $adsOrderResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-order.create', request()->query->all()));
            }
            return $smartResponse->saveDataFailed($response);
        }
    }
}
