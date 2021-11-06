<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\SfLabel;

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
use App\Requests\CategoryRefRequest;
use App\Requests\CityRefRequest;
use App\Requests\EventGalleryRequest;
use App\Requests\EventHistoryRequest;
use App\Requests\EventMemberLikeRequest;
use App\Requests\EventRequest;
use App\Requests\EventStatusRefRequest;
use App\Requests\EventWishRequest;
use App\Requests\FailedJobRequest;
use App\Requests\FontIconRequest;
use App\Requests\FontIconTypeRequest;
use App\Requests\ImageRequest;
use App\Requests\MemberInterestRequest;
use App\Requests\MemberRequest;
use App\Requests\MigrationRequest;
use App\Requests\OrderDetailRequest;
use App\Requests\OrderHistoryStatusRequest;
use App\Requests\OrderRequest;
use App\Requests\OrderStatusRequest;
use App\Requests\PermissionRequest;
use App\Requests\PersonalAccessTokenRequest;
use App\Requests\ProvincesRefRequest;
use App\Requests\RolePermissionRequest;
use App\Requests\SecurityLevelRequest;
use App\Requests\SfAccessRefRequest;
use App\Requests\SfConfigRequest;
use App\Requests\SfGroupMenuRequest;
use App\Requests\SfGroupModuleRequest;
use App\Requests\SfGroupRequest;
use App\Requests\SfLabelRequest;
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
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\EventGalleryResponse;
use App\Responses\EventHistoryResponse;
use App\Responses\EventMemberLikeResponse;
use App\Responses\EventResponse;
use App\Responses\EventStatusRefResponse;
use App\Responses\EventWishResponse;
use App\Responses\FailedJobResponse;
use App\Responses\FontIconResponse;
use App\Responses\FontIconTypeResponse;
use App\Responses\ImageResponse;
use App\Responses\MemberInterestResponse;
use App\Responses\MemberResponse;
use App\Responses\MigrationResponse;
use App\Responses\OrderDetailResponse;
use App\Responses\OrderHistoryStatusResponse;
use App\Responses\OrderResponse;
use App\Responses\OrderStatusResponse;
use App\Responses\PermissionResponse;
use App\Responses\PersonalAccessTokenResponse;
use App\Responses\ProvincesRefResponse;
use App\Responses\RolePermissionResponse;
use App\Responses\SecurityLevelResponse;
use App\Responses\SfAccessRefResponse;
use App\Responses\SfConfigResponse;
use App\Responses\SfGroupMenuResponse;
use App\Responses\SfGroupModuleResponse;
use App\Responses\SfGroupResponse;
use App\Responses\SfLabelResponse;
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
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\EventGalleryService;
use App\Services\EventHistoryService;
use App\Services\EventMemberLikeService;
use App\Services\EventService;
use App\Services\EventStatusRefService;
use App\Services\EventWishService;
use App\Services\FailedJobService;
use App\Services\FontIconService;
use App\Services\FontIconTypeService;
use App\Services\ImageService;
use App\Services\MemberInterestService;
use App\Services\MemberService;
use App\Services\MigrationService;
use App\Services\OrderDetailService;
use App\Services\OrderHistoryStatusService;
use App\Services\OrderService;
use App\Services\OrderStatusService;
use App\Services\PermissionService;
use App\Services\PersonalAccessTokenService;
use App\Services\ProvincesRefService;
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
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Requests\EventGalleryServiceRequest;
use App\Services\Requests\EventHistoryServiceRequest;
use App\Services\Requests\EventMemberLikeServiceRequest;
use App\Services\Requests\EventServiceRequest;
use App\Services\Requests\EventStatusRefServiceRequest;
use App\Services\Requests\EventWishServiceRequest;
use App\Services\Requests\FailedJobServiceRequest;
use App\Services\Requests\FontIconServiceRequest;
use App\Services\Requests\FontIconTypeServiceRequest;
use App\Services\Requests\ImageServiceRequest;
use App\Services\Requests\MemberInterestServiceRequest;
use App\Services\Requests\MemberServiceRequest;
use App\Services\Requests\MigrationServiceRequest;
use App\Services\Requests\OrderDetailServiceRequest;
use App\Services\Requests\OrderHistoryStatusServiceRequest;
use App\Services\Requests\OrderServiceRequest;
use App\Services\Requests\OrderStatusServiceRequest;
use App\Services\Requests\PermissionServiceRequest;
use App\Services\Requests\PersonalAccessTokenServiceRequest;
use App\Services\Requests\ProvincesRefServiceRequest;
use App\Services\Requests\RolePermissionServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\Requests\SfAccessRefServiceRequest;
use App\Services\Requests\SfConfigServiceRequest;
use App\Services\Requests\SfGroupMenuServiceRequest;
use App\Services\Requests\SfGroupModuleServiceRequest;
use App\Services\Requests\SfGroupServiceRequest;
use App\Services\Requests\SfLabelServiceRequest;
use App\Services\RolePermissionService;
use App\Services\SecurityLevelService;
use App\Services\SfAccessRefService;
use App\Services\SfConfigService;
use App\Services\SfGroupMenuService;
use App\Services\SfGroupModuleService;
use App\Services\SfGroupService;
use App\Services\SfLabelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:38
 * Time: 2021/11/06
 * Class SfLabelStoreController
 * @package App\Http\Controllers\SfLabel
 */
class SfLabelStoreController
{
/**
     * @OA\Post(
     *      path="/api/sf-label/store",
     *      tags={"Sf Label"},
     *      summary="Store Sf Label Data",
     *      description="Store Sf Label Data",
     *      @OA\Parameter(
     *          name="languageId",
     *          in="query",
     *          required=false,
     *          description="SfLabel languageId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="modulId",
     *          in="query",
     *          required=false,
     *          description="SfLabel modulId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="labelName",
     *          in="query",
     *          required=false,
     *          description="SfLabel labelName",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="labelValue",
     *          in="query",
     *          required=false,
     *          description="SfLabel labelValue",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="userId",
     *          in="query",
     *          required=false,
     *          description="SfLabel userId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="dateInsert",
     *          in="query",
     *          required=false,
     *          description="SfLabel dateInsert",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="dateChange",
     *          in="query",
     *          required=false,
     *          description="SfLabel dateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="publish",
     *          in="query",
     *          required=false,
     *          description="SfLabel publish",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="status",
     *          in="query",
     *          required=false,
     *          description="SfLabel status",
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
     * Returns Sf Label Store status
     */
    /**
     * @param SfLabelRequest $sfLabelRequest
     * @param SfLabelServiceRequest $sfLabelServiceRequest
     * @param SfLabelService $sfLabelService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws Exception
     */
    public function __invoke(SfLabelRequest $sfLabelRequest,
                             SfLabelServiceRequest $sfLabelServiceRequest,
                             SfLabelService $sfLabelService,
                             SfLabelResponse $sfLabelResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $sfLabelValidated = $sfLabelRequest->validated();

        $sfLabelServiceRequest = Lazy::copyFromArray($sfLabelValidated, $sfLabelServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$sfLabelService, 'store'], ['sfLabelServiceRequest' => $sfLabelServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->sfLabel, $sfLabelResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            return $smartResponse->saveDataFailed($response);
        }
    }
}
