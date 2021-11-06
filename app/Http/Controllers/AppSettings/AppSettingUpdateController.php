<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AppSettings;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\AppMenuCategoryMenuRequest;
use App\Requests\AppMenuCategoryRequest;
use App\Requests\AppMenuRequest;
use App\Requests\AppMenuRouteRequest;
use App\Requests\AppRoleMenuRequest;
use App\Requests\AppRoleRouteRequest;
use App\Requests\AppRouteRequest;
use App\Requests\AppSettingRequest;
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
use App\Responses\AppRoleRouteResponse;
use App\Responses\AppRouteResponse;
use App\Responses\AppSettingResponse;
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
use App\Services\AppRoleRouteService;
use App\Services\AppRouteService;
use App\Services\AppSettingService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\AppMenuCategoryMenuServiceRequest;
use App\Services\Requests\AppMenuCategoryServiceRequest;
use App\Services\Requests\AppMenuRouteServiceRequest;
use App\Services\Requests\AppMenuServiceRequest;
use App\Services\Requests\AppRoleMenuServiceRequest;
use App\Services\Requests\AppRoleRouteServiceRequest;
use App\Services\Requests\AppRouteServiceRequest;
use App\Services\Requests\AppSettingServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:03
 * Time: 2021/11/06
 * Class AppSettingUpdateController
 * @package App\Http\Controllers\AppSettings
 */
class AppSettingUpdateController
{
/**
     * @OA\Put(
     *      path="/api/app-setting/{id}/update",
     *      tags={"App Setting"},
     *      summary="Store App Setting Data",
     *      description="Store App Setting Data",
     *      @OA\Parameter(
     *          name="id",
     *          description="App Setting id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="date_time_format",
     *          in="query",
     *          required=true,
     *          description="AppSetting date_time_format",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="date_format",
     *          in="query",
     *          required=true,
     *          description="AppSetting date_format",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="time_format",
     *          in="query",
     *          required=true,
     *          description="AppSetting time_format",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="hour_minute_format",
     *          in="query",
     *          required=true,
     *          description="AppSetting hour_minute_format",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="user_id",
     *          in="query",
     *          required=true,
     *          description="AppSetting user_id",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="creator_id",
     *          in="query",
     *          required=true,
     *          description="AppSetting creator_id",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="owner_id",
     *          in="query",
     *          required=true,
     *          description="AppSetting owner_id",
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
     * Returns App Setting Update status
     */

    public function __invoke(int $id,
                             AppSettingRequest $appSettingRequest,
                             AppSettingServiceRequest $appSettingServiceRequest,
                             AppSettingService $appSettingService,
                             AppSettingResponse $appSettingResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $appSettingValidated = $appSettingRequest->validated();

        $appSettingServiceRequest = Lazy::copyFromArray($appSettingValidated, $appSettingServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$appSettingService, 'update'], ['id' => $id, 'appSettingServiceRequest' => $appSettingServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->appSetting, $appSettingResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
