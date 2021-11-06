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
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:58
 * Time: 2021/11/06
 * Class AppMenuCategoryUpdateController
 * @package App\Http\Controllers\AppMenuCategories
 */
class AppMenuCategoryUpdateController
{
/**
     * @OA\Put(
     *      path="/api/app-menu-category/{name}/update",
     *      tags={"App Menu Category"},
     *      summary="Store App Menu Category Data",
     *      description="Store App Menu Category Data",
     *      @OA\Parameter(
     *          name="name",
     *          description="App Menu Category name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
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
     * Returns App Menu Category Update status
     */

    public function __invoke(string $name,
                             AppMenuCategoryRequest $appMenuCategoryRequest,
                             AppMenuCategoryServiceRequest $appMenuCategoryServiceRequest,
                             AppMenuCategoryService $appMenuCategoryService,
                             AppMenuCategoryResponse $appMenuCategoryResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $appMenuCategoryValidated = $appMenuCategoryRequest->validated();

        $appMenuCategoryServiceRequest = Lazy::copyFromArray($appMenuCategoryValidated, $appMenuCategoryServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$appMenuCategoryService, 'update'], ['name' => $name, 'appMenuCategoryServiceRequest' => $appMenuCategoryServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->appMenuCategory, $appMenuCategoryResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
