<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AppMenuCategoryMenus;

use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\AppMenuCategoryMenuResponse;
use App\Responses\AppMenuCategoryResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryMenuService;
use App\Services\AppMenuCategoryService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:58
 * Time: 2021/11/06
 * Class AppMenuCategoryMenuDetailController
 * @package App\Http\Controllers\AppMenuCategoryMenus
 */
class AppMenuCategoryMenuDetailController
{

    /**
     * @OA\Get(
     *      path="/api/app-menu-category-menu/{id}/detail",
     *      tags={"App Menu Category Menu"},
     *      summary="Get App Menu Category Menu Detail",
     *      description="Returns App Menu Category Menu Detail",
     *      @OA\Parameter(
     *          name="id",
     *          description="App Menu Category Menu id",
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
     * Returns App Menu Category Menu Detail
     */

    /**
     * @param int $id
     * @param AppMenuCategoryMenuService $appMenuCategoryMenuService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $id,
                             AppMenuCategoryMenuService $appMenuCategoryMenuService,
                             AppMenuCategoryMenuResponse $appMenuCategoryMenuResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$appMenuCategoryMenuService, 'getById'], compact('id'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->appMenuCategoryMenu, $appMenuCategoryMenuResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
