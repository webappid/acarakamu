<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AdsOrderDetail;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:56
 * Time: 2021/11/06
 * Class AdsOrderDetailDeleteController
 * @package App\Http\Controllers\AdsOrderDetail
 */
class AdsOrderDetailDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/ads-order-detail/{adsOrderDetailId}/delete",
     *      tags={"Ads Order Detail"},
     *      summary="Get Ads Order Detail List",
     *      description="Returns Ads Order Detail List",
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
     * Returns Ads Order Detail List
     */
    /**
     * @param int $adsOrderDetailId
     * @param AdsOrderDetailService $adsOrderDetailService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $adsOrderDetailId,
                             AdsOrderDetailService $adsOrderDetailService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$adsOrderDetailService, 'delete'], compact('adsOrderDetailId'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
