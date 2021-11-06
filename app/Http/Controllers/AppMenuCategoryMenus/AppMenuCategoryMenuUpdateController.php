<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AppMenuCategoryMenus;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\AppMenuCategoryMenuRequest;
use App\Requests\AppMenuCategoryRequest;
use App\Requests\SecurityLevelRequest;
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
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\AppMenuCategoryMenuServiceRequest;
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
 * Class AppMenuCategoryMenuUpdateController
 * @package App\Http\Controllers\AppMenuCategoryMenus
 */
class AppMenuCategoryMenuUpdateController
{
/**
     * @OA\Put(
     *      path="/api/app-menu-category-menu/{id}/update",
     *      tags={"App Menu Category Menu"},
     *      summary="Store App Menu Category Menu Data",
     *      description="Store App Menu Category Menu Data",
     *      @OA\Parameter(
     *          name="id",
     *          description="App Menu Category Menu id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="menu_category_id",
     *          in="query",
     *          required=true,
     *          description="AppMenuCategoryMenu menu_category_id",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="menu_id",
     *          in="query",
     *          required=true,
     *          description="AppMenuCategoryMenu menu_id",
     *          @OA\Schema(
     *              type="int"
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
     * Returns App Menu Category Menu Update status
     */

    public function __invoke(int $id,
                             AppMenuCategoryMenuRequest $appMenuCategoryMenuRequest,
                             AppMenuCategoryMenuServiceRequest $appMenuCategoryMenuServiceRequest,
                             AppMenuCategoryMenuService $appMenuCategoryMenuService,
                             AppMenuCategoryMenuResponse $appMenuCategoryMenuResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $appMenuCategoryMenuValidated = $appMenuCategoryMenuRequest->validated();

        $appMenuCategoryMenuServiceRequest = Lazy::copyFromArray($appMenuCategoryMenuValidated, $appMenuCategoryMenuServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$appMenuCategoryMenuService, 'update'], ['id' => $id, 'appMenuCategoryMenuServiceRequest' => $appMenuCategoryMenuServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->appMenuCategoryMenu, $appMenuCategoryMenuResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
