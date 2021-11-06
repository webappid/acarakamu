<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AppMenuCategories;

use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\AppMenuCategoryResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:57
 * Time: 2021/11/06
 * Class AppMenuCategoryDetailController
 * @package App\Http\Controllers\AppMenuCategories
 */
class AppMenuCategoryDetailController
{

    /**
     * @OA\Get(
     *      path="/api/app-menu-category/{name}/detail",
     *      tags={"App Menu Category"},
     *      summary="Get App Menu Category Detail",
     *      description="Returns App Menu Category Detail",
     *      @OA\Parameter(
     *          name="name",
     *          description="App Menu Category name",
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
     * Returns App Menu Category Detail
     */

    /**
     * @param string $name
     * @param AppMenuCategoryService $appMenuCategoryService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(string $name,
                             AppMenuCategoryService $appMenuCategoryService,
                             AppMenuCategoryResponse $appMenuCategoryResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$appMenuCategoryService, 'getByName'], compact('name'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->appMenuCategory, $appMenuCategoryResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
