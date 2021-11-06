<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AppMenuCategories;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\AppMenuCategoryRequest;
use App\Requests\SecurityLevelRequest;
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
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\AppMenuCategoryServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:58
 * Time: 2021/11/06
 * Class AppMenuCategoryStoreController
 * @package App\Http\Controllers\AppMenuCategories
 */
class AppMenuCategoryStoreController
{
/**
     * @OA\Post(
     *      path="/api/app-menu-category/store",
     *      tags={"App Menu Category"},
     *      summary="Store App Menu Category Data",
     *      description="Store App Menu Category Data",
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="AppMenuCategory name",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=201,
     *          description="Store Data Success"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="System error"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns App Menu Category Store status
     */
    /**
     * @param AppMenuCategoryRequest $appMenuCategoryRequest
     * @param AppMenuCategoryServiceRequest $appMenuCategoryServiceRequest
     * @param AppMenuCategoryService $appMenuCategoryService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws Exception
     */
    public function __invoke(AppMenuCategoryRequest $appMenuCategoryRequest,
                             AppMenuCategoryServiceRequest $appMenuCategoryServiceRequest,
                             AppMenuCategoryService $appMenuCategoryService,
                             AppMenuCategoryResponse $appMenuCategoryResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $appMenuCategoryValidated = $appMenuCategoryRequest->validated();

        $appMenuCategoryServiceRequest = Lazy::copyFromArray($appMenuCategoryValidated, $appMenuCategoryServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$appMenuCategoryService, 'store'], ['appMenuCategoryServiceRequest' => $appMenuCategoryServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->appMenuCategory, $appMenuCategoryResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            return $smartResponse->saveDataFailed($response);
        }
    }
}
