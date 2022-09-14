<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\CityRef;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:59
 * Time: 2022/09/14
 * Class CityRefDeleteController
 * @package App\Http\Controllers\CityRef
 */
class CityRefDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/city-ref/{cityId}/delete",
     *      tags={"City Ref"},
     *      summary="Get City Ref List",
     *      description="Returns City Ref List",
     *      @OA\Parameter(
     *          name="cityId",
     *          description="City Ref cityId",
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
     * Returns City Ref List
     */
    public function __invoke(int $cityId,
                             CityRefService $cityRefService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$cityRefService, 'delete'], compact('cityId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.city-ref.index'));
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
