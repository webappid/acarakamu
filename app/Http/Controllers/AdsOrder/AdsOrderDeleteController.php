<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AdsOrder;

use App\Services\AdsEventService;
use App\Services\AdsOrderService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
 * Class AdsOrderDeleteController
 * @package App\Http\Controllers\AdsOrder
 */
class AdsOrderDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/ads-order/{adsOrderId}/delete",
     *      tags={"Ads Order"},
     *      summary="Get Ads Order List",
     *      description="Returns Ads Order List",
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
     * Returns Ads Order List
     */
    public function __invoke(int $adsOrderId,
                             AdsOrderService $adsOrderService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$adsOrderService, 'delete'], compact('adsOrderId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.ads-order.index'));
        }

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
