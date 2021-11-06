<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\CategoryRef;

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
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:04
 * Time: 2021/11/06
 * Class CategoryRefListController
 * @package App\Http\Controllers\CategoryRef
 */
class CategoryRefListController
{
    /**
     * @OA\Get(
     *      path="/api/category-ref/list",
     *      tags={"Category Ref"},
     *      summary="Get Category Ref List",
     *      description="Returns Category Ref List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Category Ref q",
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
     * Returns Category Ref List
     */
    /**
     * @param CategoryRefSearchRequest $categoryRefSearchRequest
     * @param CategoryRefService $categoryRefService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             CategoryRefSearchRequest $categoryRefSearchRequest,
                             CategoryRefService $categoryRefService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $categoryRefSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$categoryRefService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->categoryRefList as $item) {
                    $data[] = Lazy::transform($item, new CategoryRefResponse());
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
