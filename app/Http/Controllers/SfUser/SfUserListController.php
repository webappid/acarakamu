<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\SfUser;

use App\Requests\AdsEventSearchRequest;
use App\Requests\AdsOrderDetailSearchRequest;
use App\Requests\AdsOrderSearchRequest;
use App\Requests\AdsRefPriceSearchRequest;
use App\Requests\CategoryRefSearchRequest;
use App\Requests\CityRefSearchRequest;
use App\Requests\EventGallerySearchRequest;
use App\Requests\EventHistorySearchRequest;
use App\Requests\EventMemberLikeSearchRequest;
use App\Requests\EventSearchRequest;
use App\Requests\EventStatusRefSearchRequest;
use App\Requests\EventWishSearchRequest;
use App\Requests\FailedJobSearchRequest;
use App\Requests\ImageSearchRequest;
use App\Requests\MemberInterestSearchRequest;
use App\Requests\MemberSearchRequest;
use App\Requests\MigrationSearchRequest;
use App\Requests\OrderDetailSearchRequest;
use App\Requests\OrderHistoryStatusSearchRequest;
use App\Requests\OrderSearchRequest;
use App\Requests\OrderStatusSearchRequest;
use App\Requests\PermissionSearchRequest;
use App\Requests\PersonalAccessTokenSearchRequest;
use App\Requests\ProvincesRefSearchRequest;
use App\Requests\RolePermissionSearchRequest;
use App\Requests\RoleRouteSearchRequest;
use App\Requests\RouteSearchRequest;
use App\Requests\SecurityLevelSearchRequest;
use App\Requests\SfAccessRefSearchRequest;
use App\Requests\SfConfigSearchRequest;
use App\Requests\SfGroupMenuSearchRequest;
use App\Requests\SfGroupModuleSearchRequest;
use App\Requests\SfGroupSearchRequest;
use App\Requests\SfLabelSearchRequest;
use App\Requests\SfLanguageSearchRequest;
use App\Requests\SfMenuLanguageSearchRequest;
use App\Requests\SfMenuSearchRequest;
use App\Requests\SfMicroprocessInputSearchRequest;
use App\Requests\SfMicroprocessProcessSearchRequest;
use App\Requests\SfMicroprocessRefParamSearchRequest;
use App\Requests\SfMicroprocessRefProcessSearchRequest;
use App\Requests\SfMicroprocessSearchRequest;
use App\Requests\SfModuleSearchRequest;
use App\Requests\SfUserSearchRequest;
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
use App\Responses\SfUserResponse;
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
use App\Services\SfUserService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
use WebAppId\User\Services\PermissionService;
use WebAppId\User\Services\RouteService;

/**
 * @author: 
 * Date: 16:04:41
 * Time: 2022/09/14
 * Class SfUserListController
 * @package App\Http\Controllers\SfUser
 */
class SfUserListController
{
    /**
     * @OA\Get(
     *      path="/api/sf-user/list",
     *      tags={"Sf User"},
     *      summary="Get Sf User List",
     *      description="Returns Sf User List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Sf User q",
     *          in="query",
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
     * Returns Sf User List
     */
    public function __invoke(
                             SfUserSearchRequest $sfUserSearchRequest,
                             SfUserService $sfUserService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $sfUserSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$sfUserService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->sfUserList as $item) {
                $data[] = Lazy::transform($item, new SfUserResponse());
            }
        }

        if ($result->status) {
            $response->setData($data);
            $response->setRecordsTotal($result->count);
            $response->setRecordsFiltered($result->countFiltered);
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
