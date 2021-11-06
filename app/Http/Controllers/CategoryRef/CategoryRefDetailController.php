<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\CategoryRef;

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
 * Class CategoryRefDetailController
 * @package App\Http\Controllers\CategoryRef
 */
class CategoryRefDetailController
{

    /**
     * @OA\Get(
     *      path="/api/category-ref/{categoryId}/detail",
     *      tags={"Category Ref"},
     *      summary="Get Category Ref Detail",
     *      description="Returns Category Ref Detail",
     *      @OA\Parameter(
     *          name="categoryId",
     *          description="Category Ref categoryId",
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
     * Returns Category Ref Detail
     */

    /**
     * @param int $categoryId
     * @param CategoryRefService $categoryRefService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $categoryId,
                             CategoryRefService $categoryRefService,
                             CategoryRefResponse $categoryRefResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$categoryRefService, 'getByCategoryId'], compact('categoryId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->categoryRef, $categoryRefResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
