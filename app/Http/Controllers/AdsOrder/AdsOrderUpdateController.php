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
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
 * Class AdsOrderUpdateController
 * @package App\Http\Controllers\AdsOrder
 */
class AdsOrderUpdateController
{
/**
     * @OA\Put(
     *      path="/api/ads-order/{adsOrderId}/update",
     *      tags={"Ads Order"},
     *      summary="Store Ads Order Data",
     *      description="Store Ads Order Data",
     *      @OA\Parameter(
     *          name="adsOrderId",
     *          description="Ads Order adsOrderId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
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
     * Returns Ads Order Update status
     */

    public function __invoke(int $adsOrderId,
                             AdsOrderRequest $adsOrderRequest,
                             AdsOrderServiceRequest $adsOrderServiceRequest,
                             AdsOrderService $adsOrderService,
                             AdsOrderResponse $adsOrderResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $adsOrderValidated = $adsOrderRequest->validated();

        $adsOrderServiceRequest = Lazy::copyFromArray($adsOrderValidated, $adsOrderServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$adsOrderService, 'update'], ['adsOrderId' => $adsOrderId, 'adsOrderServiceRequest' => $adsOrderServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-order.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->adsOrder, $adsOrderResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.ads-order.edit', array_merge(['adsOrderId' => $adsOrderId], request()->query->all())));
            }
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
