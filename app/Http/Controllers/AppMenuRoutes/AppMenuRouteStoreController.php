<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AppMenuRoutes;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\AppMenuCategoryMenuRequest;
use App\Requests\AppMenuCategoryRequest;
use App\Requests\AppMenuRouteRequest;
use App\Requests\SecurityLevelRequest;
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
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\AppMenuCategoryMenuServiceRequest;
use App\Services\Requests\AppMenuCategoryServiceRequest;
use App\Services\Requests\AppMenuRouteServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:59
 * Time: 2021/11/06
 * Class AppMenuRouteStoreController
 * @package App\Http\Controllers\AppMenuRoutes
 */
class AppMenuRouteStoreController
{
/**
     * @OA\Post(
     *      path="/api/app-menu-route/store",
     *      tags={"App Menu Route"},
     *      summary="Store App Menu Route Data",
     *      description="Store App Menu Route Data",
     *      @OA\Parameter(
     *          name="menu_id",
     *          in="query",
     *          required=true,
     *          description="AppMenuRoute menu_id",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="route_id",
     *          in="query",
     *          required=true,
     *          description="AppMenuRoute route_id",
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
     * Returns App Menu Route Store status
     */
    /**
     * @param AppMenuRouteRequest $appMenuRouteRequest
     * @param AppMenuRouteServiceRequest $appMenuRouteServiceRequest
     * @param AppMenuRouteService $appMenuRouteService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws Exception
     */
    public function __invoke(AppMenuRouteRequest $appMenuRouteRequest,
                             AppMenuRouteServiceRequest $appMenuRouteServiceRequest,
                             AppMenuRouteService $appMenuRouteService,
                             AppMenuRouteResponse $appMenuRouteResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $appMenuRouteValidated = $appMenuRouteRequest->validated();

        $appMenuRouteServiceRequest = Lazy::copyFromArray($appMenuRouteValidated, $appMenuRouteServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$appMenuRouteService, 'store'], ['appMenuRouteServiceRequest' => $appMenuRouteServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->appMenuRoute, $appMenuRouteResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            return $smartResponse->saveDataFailed($response);
        }
    }
}
