<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\SystemLog;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\CategoryRefRequest;
use App\Requests\CityRefRequest;
use App\Requests\EventGalleryRequest;
use App\Requests\EventHistoryRequest;
use App\Requests\EventMemberLikeRequest;
use App\Requests\EventRequest;
use App\Requests\EventStatusRefRequest;
use App\Requests\EventWishRequest;
use App\Requests\FailedJobRequest;
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
use App\Requests\RoleRouteRequest;
use App\Requests\RouteRequest;
use App\Requests\SecurityLevelRequest;
use App\Requests\SfAccessRefRequest;
use App\Requests\SfConfigRequest;
use App\Requests\SfGroupMenuRequest;
use App\Requests\SfGroupModuleRequest;
use App\Requests\SfGroupRequest;
use App\Requests\SfLabelRequest;
use App\Requests\SfLanguageRequest;
use App\Requests\SfMenuLanguageRequest;
use App\Requests\SfMenuRequest;
use App\Requests\SfMicroprocessInputRequest;
use App\Requests\SfMicroprocessProcessRequest;
use App\Requests\SfMicroprocessRefParamRequest;
use App\Requests\SfMicroprocessRefProcessRequest;
use App\Requests\SfMicroprocessRequest;
use App\Requests\SfModuleRequest;
use App\Requests\SfUserRequest;
use App\Requests\SfUserResetPasswordHistRequest;
use App\Requests\SystemLogRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\EventGalleryResponse;
use App\Responses\EventHistoryResponse;
use App\Responses\EventMemberLikeResponse;
use App\Responses\EventResponse;
use App\Responses\EventStatusRefResponse;
use App\Responses\EventWishResponse;
use App\Responses\FailedJobResponse;
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
use App\Responses\RoleRouteResponse;
use App\Responses\RouteResponse;
use App\Responses\SecurityLevelResponse;
use App\Responses\SfAccessRefResponse;
use App\Responses\SfConfigResponse;
use App\Responses\SfGroupMenuResponse;
use App\Responses\SfGroupModuleResponse;
use App\Responses\SfGroupResponse;
use App\Responses\SfLabelResponse;
use App\Responses\SfLanguageResponse;
use App\Responses\SfMenuLanguageResponse;
use App\Responses\SfMenuResponse;
use App\Responses\SfMicroprocessInputResponse;
use App\Responses\SfMicroprocessProcessResponse;
use App\Responses\SfMicroprocessRefParamResponse;
use App\Responses\SfMicroprocessRefProcessResponse;
use App\Responses\SfMicroprocessResponse;
use App\Responses\SfModuleResponse;
use App\Responses\SfUserResetPasswordHistResponse;
use App\Responses\SfUserResponse;
use App\Responses\SystemLogResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\EventGalleryService;
use App\Services\EventHistoryService;
use App\Services\EventMemberLikeService;
use App\Services\EventService;
use App\Services\EventStatusRefService;
use App\Services\EventWishService;
use App\Services\FailedJobService;
use App\Services\ImageService;
use App\Services\MemberInterestService;
use App\Services\MemberService;
use App\Services\MigrationService;
use App\Services\OrderDetailService;
use App\Services\OrderHistoryStatusService;
use App\Services\OrderService;
use App\Services\OrderStatusService;
use App\Services\PersonalAccessTokenService;
use App\Services\ProvincesRefService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Requests\EventGalleryServiceRequest;
use App\Services\Requests\EventHistoryServiceRequest;
use App\Services\Requests\EventMemberLikeServiceRequest;
use App\Services\Requests\EventServiceRequest;
use App\Services\Requests\EventStatusRefServiceRequest;
use App\Services\Requests\EventWishServiceRequest;
use App\Services\Requests\FailedJobServiceRequest;
use App\Services\Requests\ImageServiceRequest;
use App\Services\Requests\MemberInterestServiceRequest;
use App\Services\Requests\MemberServiceRequest;
use App\Services\Requests\MigrationServiceRequest;
use App\Services\Requests\OrderDetailServiceRequest;
use App\Services\Requests\OrderHistoryStatusServiceRequest;
use App\Services\Requests\OrderServiceRequest;
use App\Services\Requests\OrderStatusServiceRequest;
use App\Services\Requests\PersonalAccessTokenServiceRequest;
use App\Services\Requests\ProvincesRefServiceRequest;
use App\Services\Requests\RolePermissionServiceRequest;
use App\Services\Requests\RoleRouteServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\Requests\SfAccessRefServiceRequest;
use App\Services\Requests\SfConfigServiceRequest;
use App\Services\Requests\SfGroupMenuServiceRequest;
use App\Services\Requests\SfGroupModuleServiceRequest;
use App\Services\Requests\SfGroupServiceRequest;
use App\Services\Requests\SfLabelServiceRequest;
use App\Services\Requests\SfLanguageServiceRequest;
use App\Services\Requests\SfMenuLanguageServiceRequest;
use App\Services\Requests\SfMenuServiceRequest;
use App\Services\Requests\SfMicroprocessInputServiceRequest;
use App\Services\Requests\SfMicroprocessProcessServiceRequest;
use App\Services\Requests\SfMicroprocessRefParamServiceRequest;
use App\Services\Requests\SfMicroprocessRefProcessServiceRequest;
use App\Services\Requests\SfMicroprocessServiceRequest;
use App\Services\Requests\SfModuleServiceRequest;
use App\Services\Requests\SfUserResetPasswordHistServiceRequest;
use App\Services\Requests\SfUserServiceRequest;
use App\Services\Requests\SystemLogServiceRequest;
use App\Services\RolePermissionService;
use App\Services\RoleRouteService;
use App\Services\SecurityLevelService;
use App\Services\SfAccessRefService;
use App\Services\SfConfigService;
use App\Services\SfGroupMenuService;
use App\Services\SfGroupModuleService;
use App\Services\SfGroupService;
use App\Services\SfLabelService;
use App\Services\SfLanguageService;
use App\Services\SfMenuLanguageService;
use App\Services\SfMenuService;
use App\Services\SfMicroprocessInputService;
use App\Services\SfMicroprocessProcessService;
use App\Services\SfMicroprocessRefParamService;
use App\Services\SfMicroprocessRefProcessService;
use App\Services\SfMicroprocessService;
use App\Services\SfModuleService;
use App\Services\SfUserResetPasswordHistService;
use App\Services\SfUserService;
use App\Services\SystemLogService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
use WebAppId\User\Services\PermissionService;
use WebAppId\User\Services\Requests\PermissionServiceRequest;
use WebAppId\User\Services\Requests\RouteServiceRequest;
use WebAppId\User\Services\RouteService;

/**
 * @author: 
 * Date: 16:04:44
 * Time: 2022/09/14
 * Class SystemLogUpdateController
 * @package App\Http\Controllers\SystemLog
 */
class SystemLogUpdateController
{
/**
     * @OA\Put(
     *      path="/api/system-log/{logId}/update",
     *      tags={"System Log"},
     *      summary="Store System Log Data",
     *      description="Store System Log Data",
     *      @OA\Parameter(
     *          name="logId",
     *          description="System Log logId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="logValue",
     *          in="query",
     *          required=false,
     *          description="SystemLog logValue",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="logTimeStam",
     *          in="query",
     *          required=true,
     *          description="SystemLog logTimeStam",
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
     * Returns System Log Update status
     */

    public function __invoke(int $logId,
                             SystemLogRequest $systemLogRequest,
                             SystemLogServiceRequest $systemLogServiceRequest,
                             SystemLogService $systemLogService,
                             SystemLogResponse $systemLogResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $systemLogValidated = $systemLogRequest->validated();

        $systemLogServiceRequest = Lazy::copyFromArray($systemLogValidated, $systemLogServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$systemLogService, 'update'], ['logId' => $logId, 'systemLogServiceRequest' => $systemLogServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.system-log.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->systemLog, $systemLogResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.system-log.edit', array_merge(['logId' => $logId], request()->query->all())));
            }
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
