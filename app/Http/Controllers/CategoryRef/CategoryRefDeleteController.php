<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\CategoryRef;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:58
 * Time: 2022/09/14
 * Class CategoryRefDeleteController
 * @package App\Http\Controllers\CategoryRef
 */
class CategoryRefDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/category-ref/{categoryId}/delete",
     *      tags={"Category Ref"},
     *      summary="Get Category Ref List",
     *      description="Returns Category Ref List",
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
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns Category Ref List
     */
    public function __invoke(int $categoryId,
                             CategoryRefService $categoryRefService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$categoryRefService, 'delete'], compact('categoryId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.category-ref.index'));
        }

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
