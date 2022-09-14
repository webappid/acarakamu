<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\SfMenu;

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
use App\Requests\SfMenuRequest;
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
use App\Responses\SfMenuResponse;
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
use App\Services\Requests\SfMenuServiceRequest;
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
use App\Services\SfMenuService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
use WebAppId\User\Services\PermissionService;
use WebAppId\User\Services\Requests\PermissionServiceRequest;
use WebAppId\User\Services\Requests\RouteServiceRequest;
use WebAppId\User\Services\RouteService;

/**
 * @author: 
 * Date: 16:04:31
 * Time: 2022/09/14
 * Class SfMenuStoreController
 * @package App\Http\Controllers\SfMenu
 */
class SfMenuStoreController
{
/**
     * @OA\Post(
     *      path="/api/sf-menu/store",
     *      tags={"Sf Menu"},
     *      summary="Store Sf Menu Data",
     *      description="Store Sf Menu Data",
     *      @OA\Parameter(
     *          name="menuName",
     *          in="query",
     *          required=false,
     *          description="SfMenu menuName",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="menuPath",
     *          in="query",
     *          required=false,
     *          description="SfMenu menuPath",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="moduleId",
     *          in="query",
     *          required=false,
     *          description="SfMenu moduleId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="parentLink",
     *          in="query",
     *          required=false,
     *          description="SfMenu parentLink",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="menuIcon",
     *          in="query",
     *          required=false,
     *          description="SfMenu menuIcon",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="order",
     *          in="query",
     *          required=false,
     *          description="SfMenu order",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="userId",
     *          in="query",
     *          required=false,
     *          description="SfMenu userId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="dateChange",
     *          in="query",
     *          required=false,
     *          description="SfMenu dateChange",
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
     * Returns Sf Menu Store status
     */
    public function __invoke(SfMenuRequest $sfMenuRequest,
                             SfMenuServiceRequest $sfMenuServiceRequest,
                             SfMenuService $sfMenuService,
                             SfMenuResponse $sfMenuResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $sfMenuValidated = $sfMenuRequest->validated();

        $sfMenuServiceRequest = Lazy::copyFromArray($sfMenuValidated, $sfMenuServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$sfMenuService, 'store'], ['sfMenuServiceRequest' => $sfMenuServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.sf-menu.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->sfMenu, $sfMenuResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.sf-menu.create', request()->query->all()));
            }
            return $smartResponse->saveDataFailed($response);
        }
    }
}
