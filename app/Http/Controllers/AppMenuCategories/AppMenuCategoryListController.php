<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AppMenuCategories;

use App\Requests\AdsEventSearchRequest;
use App\Requests\AdsOrderDetailSearchRequest;
use App\Requests\AdsOrderSearchRequest;
use App\Requests\AdsRefPriceSearchRequest;
use App\Requests\AppMenuCategorySearchRequest;
use App\Requests\SecurityLevelSearchRequest;
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
 * Date: 14:03:58
 * Time: 2021/11/06
 * Class AppMenuCategoryListController
 * @package App\Http\Controllers\AppMenuCategories
 */
class AppMenuCategoryListController
{
    /**
     * @OA\Get(
     *      path="/api/app-menu-category/list",
     *      tags={"App Menu Category"},
     *      summary="Get App Menu Category List",
     *      description="Returns App Menu Category List",
     *      @OA\Parameter(
     *          name="q",
     *          description="App Menu Category q",
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
     * Returns App Menu Category List
     */
    /**
     * @param AppMenuCategorySearchRequest $appMenuCategorySearchRequest
     * @param AppMenuCategoryService $appMenuCategoryService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             AppMenuCategorySearchRequest $appMenuCategorySearchRequest,
                             AppMenuCategoryService $appMenuCategoryService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $appMenuCategorySearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$appMenuCategoryService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->appMenuCategoryList as $item) {
                    $data[] = Lazy::transform($item, new AppMenuCategoryResponse());
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
