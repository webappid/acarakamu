<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\CategoryRef;

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
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:58
 * Time: 2022/09/14
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
