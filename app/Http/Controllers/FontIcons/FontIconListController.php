<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\FontIcons;

use App\Requests\AdsEventSearchRequest;
use App\Requests\AdsOrderDetailSearchRequest;
use App\Requests\AdsOrderSearchRequest;
use App\Requests\AdsRefPriceSearchRequest;
use App\Requests\AppMenuCategoryMenuSearchRequest;
use App\Requests\AppMenuCategorySearchRequest;
use App\Requests\AppMenuRouteSearchRequest;
use App\Requests\AppMenuSearchRequest;
use App\Requests\AppRoleMenuSearchRequest;
use App\Requests\AppRoleRouteSearchRequest;
use App\Requests\AppRouteSearchRequest;
use App\Requests\AppSettingSearchRequest;
use App\Requests\CategoryRefSearchRequest;
use App\Requests\CityRefSearchRequest;
use App\Requests\EventGallerySearchRequest;
use App\Requests\EventHistorySearchRequest;
use App\Requests\EventMemberLikeSearchRequest;
use App\Requests\EventSearchRequest;
use App\Requests\EventStatusRefSearchRequest;
use App\Requests\EventWishSearchRequest;
use App\Requests\FailedJobSearchRequest;
use App\Requests\FontIconSearchRequest;
use App\Requests\FontIconTypeSearchRequest;
use App\Requests\SecurityLevelSearchRequest;
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
 * Class FontIconListController
 * @package App\Http\Controllers\FontIcons
 */
class FontIconListController
{
    /**
     * @OA\Get(
     *      path="/api/font-icon/list",
     *      tags={"Font Icon"},
     *      summary="Get Font Icon List",
     *      description="Returns Font Icon List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Font Icon q",
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
     * Returns Font Icon List
     */
    /**
     * @param FontIconSearchRequest $fontIconSearchRequest
     * @param FontIconService $fontIconService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             FontIconSearchRequest $fontIconSearchRequest,
                             FontIconService $fontIconService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $fontIconSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$fontIconService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->fontIconList as $item) {
                    $data[] = Lazy::transform($item, new FontIconResponse());
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
