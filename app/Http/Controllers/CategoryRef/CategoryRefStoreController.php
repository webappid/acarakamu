<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\CategoryRef;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\CategoryRefRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:58
 * Time: 2022/09/14
 * Class CategoryRefStoreController
 * @package App\Http\Controllers\CategoryRef
 */
class CategoryRefStoreController
{
/**
     * @OA\Post(
     *      path="/api/category-ref/store",
     *      tags={"Category Ref"},
     *      summary="Store Category Ref Data",
     *      description="Store Category Ref Data",
     *      @OA\Parameter(
     *          name="categoryNama",
     *          in="query",
     *          required=true,
     *          description="CategoryRef categoryNama",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="categoryImageId",
     *          in="query",
     *          required=false,
     *          description="CategoryRef categoryImageId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="categoryIcon",
     *          in="query",
     *          required=true,
     *          description="CategoryRef categoryIcon",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="categoryStatusAktif",
     *          in="query",
     *          required=true,
     *          description="CategoryRef categoryStatusAktif",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="categoryDateChange",
     *          in="query",
     *          required=true,
     *          description="CategoryRef categoryDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="categoryOrderBy",
     *          in="query",
     *          required=true,
     *          description="CategoryRef categoryOrderBy",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="categoryUserId",
     *          in="query",
     *          required=true,
     *          description="CategoryRef categoryUserId",
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
     * Returns Category Ref Store status
     */
    public function __invoke(CategoryRefRequest $categoryRefRequest,
                             CategoryRefServiceRequest $categoryRefServiceRequest,
                             CategoryRefService $categoryRefService,
                             CategoryRefResponse $categoryRefResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $categoryRefValidated = $categoryRefRequest->validated();

        $categoryRefServiceRequest = Lazy::copyFromArray($categoryRefValidated, $categoryRefServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$categoryRefService, 'store'], ['categoryRefServiceRequest' => $categoryRefServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.category-ref.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->categoryRef, $categoryRefResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.category-ref.create', request()->query->all()));
            }
            return $smartResponse->saveDataFailed($response);
        }
    }
}
