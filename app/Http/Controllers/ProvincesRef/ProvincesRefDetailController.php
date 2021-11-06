<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\ProvincesRef;

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
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:29
 * Time: 2021/11/06
 * Class ProvincesRefDetailController
 * @package App\Http\Controllers\ProvincesRef
 */
class ProvincesRefDetailController
{

    /**
     * @OA\Get(
     *      path="/api/provinces-ref/{provincesRefId}/detail",
     *      tags={"Provinces Ref"},
     *      summary="Get Provinces Ref Detail",
     *      description="Returns Provinces Ref Detail",
     *      @OA\Parameter(
     *          name="provincesRefId",
     *          description="Provinces Ref provincesRefId",
     *          required=true,
     *          in="path",
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
     * Returns Provinces Ref Detail
     */

    /**
     * @param int $provincesRefId
     * @param ProvincesRefService $provincesRefService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $provincesRefId,
                             ProvincesRefService $provincesRefService,
                             ProvincesRefResponse $provincesRefResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$provincesRefService, 'getByProvincesRefId'], compact('provincesRefId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->provincesRef, $provincesRefResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
