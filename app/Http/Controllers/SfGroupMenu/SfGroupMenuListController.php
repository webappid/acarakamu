<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\SfGroupMenu;

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
use App\Requests\SfGroupSearchRequest;
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
use App\Responses\SfGroupResponse;
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
use App\Services\SfGroupService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
use WebAppId\User\Services\PermissionService;
use WebAppId\User\Services\RouteService;

/**
 * @author: 
 * Date: 16:04:26
 * Time: 2022/09/14
 * Class SfGroupMenuListController
 * @package App\Http\Controllers\SfGroupMenu
 */
class SfGroupMenuListController
{
    /**
     * @OA\Get(
     *      path="/api/sf-group-menu/list",
     *      tags={"Sf Group Menu"},
     *      summary="Get Sf Group Menu List",
     *      description="Returns Sf Group Menu List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Sf Group Menu q",
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
     * Returns Sf Group Menu List
     */
    public function __invoke(
                             SfGroupMenuSearchRequest $sfGroupMenuSearchRequest,
                             SfGroupMenuService $sfGroupMenuService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $sfGroupMenuSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$sfGroupMenuService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->sfGroupMenuList as $item) {
                $data[] = Lazy::transform($item, new SfGroupMenuResponse());
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
