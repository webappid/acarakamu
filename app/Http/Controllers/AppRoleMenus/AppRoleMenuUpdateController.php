<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AppRoleMenus;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\AppMenuCategoryMenuRequest;
use App\Requests\AppMenuCategoryRequest;
use App\Requests\AppMenuRequest;
use App\Requests\AppMenuRouteRequest;
use App\Requests\AppRoleMenuRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\AppMenuCategoryMenuResponse;
use App\Responses\AppMenuCategoryResponse;
use App\Responses\AppMenuResponse;
use App\Responses\AppMenuRouteResponse;
use App\Responses\AppRoleMenuResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryMenuService;
use App\Services\AppMenuCategoryService;
use App\Services\AppMenuRouteService;
use App\Services\AppMenuService;
use App\Services\AppRoleMenuService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\AppMenuCategoryMenuServiceRequest;
use App\Services\Requests\AppMenuCategoryServiceRequest;
use App\Services\Requests\AppMenuRouteServiceRequest;
use App\Services\Requests\AppMenuServiceRequest;
use App\Services\Requests\AppRoleMenuServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:01
 * Time: 2021/11/06
 * Class AppRoleMenuUpdateController
 * @package App\Http\Controllers\AppRoleMenus
 */
class AppRoleMenuUpdateController
{
/**
     * @OA\Put(
     *      path="/api/app-role-menu/{id}/update",
     *      tags={"App Role Menu"},
     *      summary="Store App Role Menu Data",
     *      description="Store App Role Menu Data",
     *      @OA\Parameter(
     *          name="id",
     *          description="App Role Menu id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="menu_id",
     *          in="query",
     *          required=true,
     *          description="AppRoleMenu menu_id",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="role_id",
     *          in="query",
     *          required=true,
     *          description="AppRoleMenu role_id",
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
     * Returns App Role Menu Update status
     */

    public function __invoke(int $id,
                             AppRoleMenuRequest $appRoleMenuRequest,
                             AppRoleMenuServiceRequest $appRoleMenuServiceRequest,
                             AppRoleMenuService $appRoleMenuService,
                             AppRoleMenuResponse $appRoleMenuResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $appRoleMenuValidated = $appRoleMenuRequest->validated();

        $appRoleMenuServiceRequest = Lazy::copyFromArray($appRoleMenuValidated, $appRoleMenuServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$appRoleMenuService, 'update'], ['id' => $id, 'appRoleMenuServiceRequest' => $appRoleMenuServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->appRoleMenu, $appRoleMenuResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
