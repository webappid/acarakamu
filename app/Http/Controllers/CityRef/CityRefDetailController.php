<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\CityRef;

use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:59
 * Time: 2022/09/14
 * Class CityRefDetailController
 * @package App\Http\Controllers\CityRef
 */
class CityRefDetailController
{

    /**
     * @OA\Get(
     *      path="/api/city-ref/{cityId}/detail",
     *      tags={"City Ref"},
     *      summary="Get City Ref Detail",
     *      description="Returns City Ref Detail",
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
     * Returns City Ref Detail
     */
    public function __invoke(int $cityId,
                             CityRefService $cityRefService,
                             CityRefResponse $cityRefResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$cityRefService, 'getByCityId'], compact('cityId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->cityRef, $cityRefResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
