<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AppMenuCategoryMenus;

use App\Requests\AdsEventSearchRequest;
use App\Requests\AdsOrderDetailSearchRequest;
use App\Requests\AdsOrderSearchRequest;
use App\Requests\AdsRefPriceSearchRequest;
use App\Requests\AppMenuCategoryMenuSearchRequest;
use App\Requests\AppMenuCategorySearchRequest;
use App\Requests\SecurityLevelSearchRequest;
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
 * Class AppMenuCategoryMenuListController
 * @package App\Http\Controllers\AppMenuCategoryMenus
 */
class AppMenuCategoryMenuListController
{
    /**
     * @OA\Get(
     *      path="/api/app-menu-category-menu/list",
     *      tags={"App Menu Category Menu"},
     *      summary="Get App Menu Category Menu List",
     *      description="Returns App Menu Category Menu List",
     *      @OA\Parameter(
     *          name="q",
     *          description="App Menu Category Menu q",
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
     * Returns App Menu Category Menu List
     */
    /**
     * @param AppMenuCategoryMenuSearchRequest $appMenuCategoryMenuSearchRequest
     * @param AppMenuCategoryMenuService $appMenuCategoryMenuService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             AppMenuCategoryMenuSearchRequest $appMenuCategoryMenuSearchRequest,
                             AppMenuCategoryMenuService $appMenuCategoryMenuService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $appMenuCategoryMenuSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$appMenuCategoryMenuService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->appMenuCategoryMenuList as $item) {
                    $data[] = Lazy::transform($item, new AppMenuCategoryMenuResponse());
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
