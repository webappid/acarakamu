<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AdsRefPrice;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
 * Class AdsRefPriceDeleteController
 * @package App\Http\Controllers\AdsRefPrice
 */
class AdsRefPriceDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/ads-ref-price/{adsPriceRefId}/delete",
     *      tags={"Ads Ref Price"},
     *      summary="Get Ads Ref Price List",
     *      description="Returns Ads Ref Price List",
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
     * Returns Ads Ref Price List
     */
    public function __invoke(int $adsPriceRefId,
                             AdsRefPriceService $adsRefPriceService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$adsRefPriceService, 'delete'], compact('adsPriceRefId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.ads-ref-price.index'));
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
