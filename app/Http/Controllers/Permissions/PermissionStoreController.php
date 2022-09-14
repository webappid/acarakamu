<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\Permissions;

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
use App\Requests\SecurityLevelRequest;
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
use App\Responses\SecurityLevelResponse;
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
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
use WebAppId\User\Services\PermissionService;
use WebAppId\User\Services\Requests\PermissionServiceRequest;

/**
 * @author: 
 * Date: 16:04:17
 * Time: 2022/09/14
 * Class PermissionStoreController
 * @package App\Http\Controllers\Permissions
 */
class PermissionStoreController
{
/**
     * @OA\Post(
     *      path="/api/permission/store",
     *      tags={"Permission"},
     *      summary="Store Permission Data",
     *      description="Store Permission Data",
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=false,
     *          description="Permission name",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          in="query",
     *          required=false,
     *          description="Permission description",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="created_by",
     *          in="query",
     *          required=false,
     *          description="Permission created_by",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="updated_by",
     *          in="query",
     *          required=false,
     *          description="Permission updated_by",
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
     * Returns Permission Store status
     */
    public function __invoke(PermissionRequest $permissionRequest,
                             PermissionServiceRequest $permissionServiceRequest,
                             PermissionService $permissionService,
                             PermissionResponse $permissionResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $permissionValidated = $permissionRequest->validated();

        $permissionServiceRequest = Lazy::copyFromArray($permissionValidated, $permissionServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$permissionService, 'store'], ['permissionServiceRequest' => $permissionServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.permission.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->permission, $permissionResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.permission.create', request()->query->all()));
            }
            return $smartResponse->saveDataFailed($response);
        }
    }
}
