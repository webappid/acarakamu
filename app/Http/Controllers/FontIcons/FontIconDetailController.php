<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\FontIcons;

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
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:14
 * Time: 2021/11/06
 * Class FontIconDetailController
 * @package App\Http\Controllers\FontIcons
 */
class FontIconDetailController
{

    /**
     * @OA\Get(
     *      path="/api/font-icon/{id}/detail",
     *      tags={"Font Icon"},
     *      summary="Get Font Icon Detail",
     *      description="Returns Font Icon Detail",
     *      @OA\Parameter(
     *          name="id",
     *          description="Font Icon id",
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
     * Returns Font Icon Detail
     */

    /**
     * @param int $id
     * @param FontIconService $fontIconService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $id,
                             FontIconService $fontIconService,
                             FontIconResponse $fontIconResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$fontIconService, 'getById'], compact('id'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->fontIcon, $fontIconResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
