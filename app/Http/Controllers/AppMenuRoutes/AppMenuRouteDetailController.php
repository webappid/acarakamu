<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AppMenuRoutes;

use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\AppMenuCategoryMenuResponse;
use App\Responses\AppMenuCategoryResponse;
use App\Responses\AppMenuRouteResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryMenuService;
use App\Services\AppMenuCategoryService;
use App\Services\AppMenuRouteService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:59
 * Time: 2021/11/06
 * Class AppMenuRouteDetailController
 * @package App\Http\Controllers\AppMenuRoutes
 */
class AppMenuRouteDetailController
{

    /**
     * @OA\Get(
     *      path="/api/app-menu-route/{id}/detail",
     *      tags={"App Menu Route"},
     *      summary="Get App Menu Route Detail",
     *      description="Returns App Menu Route Detail",
     *      @OA\Parameter(
     *          name="id",
     *          description="App Menu Route id",
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
     * Returns App Menu Route Detail
     */

    /**
     * @param int $id
     * @param AppMenuRouteService $appMenuRouteService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $id,
                             AppMenuRouteService $appMenuRouteService,
                             AppMenuRouteResponse $appMenuRouteResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$appMenuRouteService, 'getById'], compact('id'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->appMenuRoute, $appMenuRouteResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
