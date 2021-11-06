<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AppMenus;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\AppMenuCategoryMenuRequest;
use App\Requests\AppMenuCategoryRequest;
use App\Requests\AppMenuRequest;
use App\Requests\AppMenuRouteRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\AppMenuCategoryMenuResponse;
use App\Responses\AppMenuCategoryResponse;
use App\Responses\AppMenuResponse;
use App\Responses\AppMenuRouteResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryMenuService;
use App\Services\AppMenuCategoryService;
use App\Services\AppMenuRouteService;
use App\Services\AppMenuService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\AppMenuCategoryMenuServiceRequest;
use App\Services\Requests\AppMenuCategoryServiceRequest;
use App\Services\Requests\AppMenuRouteServiceRequest;
use App\Services\Requests\AppMenuServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppMenuStoreController
 * @package App\Http\Controllers\AppMenus
 */
class AppMenuStoreController
{
/**
     * @OA\Post(
     *      path="/api/app-menu/store",
     *      tags={"App Menu"},
     *      summary="Store App Menu Data",
     *      description="Store App Menu Data",
     *      @OA\Parameter(
     *          name="parent_id",
     *          in="query",
     *          required=false,
     *          description="AppMenu parent_id",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="AppMenu name",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="route_id",
     *          in="query",
     *          required=false,
     *          description="AppMenu route_id",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="icon",
     *          in="query",
     *          required=false,
     *          description="AppMenu icon",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="menu_order",
     *          in="query",
     *          required=true,
     *          description="AppMenu menu_order",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="is_active",
     *          in="query",
     *          required=true,
     *          description="AppMenu is_active",
     *          @OA\Schema(
     *              type="string"
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
     * Returns App Menu Store status
     */
    /**
     * @param AppMenuRequest $appMenuRequest
     * @param AppMenuServiceRequest $appMenuServiceRequest
     * @param AppMenuService $appMenuService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws Exception
     */
    public function __invoke(AppMenuRequest $appMenuRequest,
                             AppMenuServiceRequest $appMenuServiceRequest,
                             AppMenuService $appMenuService,
                             AppMenuResponse $appMenuResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $appMenuValidated = $appMenuRequest->validated();

        $appMenuServiceRequest = Lazy::copyFromArray($appMenuValidated, $appMenuServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$appMenuService, 'store'], ['appMenuServiceRequest' => $appMenuServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->appMenu, $appMenuResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            return $smartResponse->saveDataFailed($response);
        }
    }
}
