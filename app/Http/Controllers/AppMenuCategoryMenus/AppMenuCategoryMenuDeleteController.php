<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AppMenuCategoryMenus;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryMenuService;
use App\Services\AppMenuCategoryService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:58
 * Time: 2021/11/06
 * Class AppMenuCategoryMenuDeleteController
 * @package App\Http\Controllers\AppMenuCategoryMenus
 */
class AppMenuCategoryMenuDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/app-menu-category-menu/{id}/delete",
     *      tags={"App Menu Category Menu"},
     *      summary="Get App Menu Category Menu List",
     *      description="Returns App Menu Category Menu List",
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
     * Returns App Menu Category Menu List
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
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$appMenuCategoryMenuService, 'delete'], compact('id'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
