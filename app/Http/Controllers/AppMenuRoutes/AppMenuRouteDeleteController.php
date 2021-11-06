<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AppMenuRoutes;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryMenuService;
use App\Services\AppMenuCategoryService;
use App\Services\AppMenuRouteService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:59
 * Time: 2021/11/06
 * Class AppMenuRouteDeleteController
 * @package App\Http\Controllers\AppMenuRoutes
 */
class AppMenuRouteDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/app-menu-route/{id}/delete",
     *      tags={"App Menu Route"},
     *      summary="Get App Menu Route List",
     *      description="Returns App Menu Route List",
     *      @OA\Parameter(
     *          name="id",
     *          description="App Menu Route id",
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
     * Returns App Menu Route List
     */
    /**
     * @param int $id
     * @param AppMenuRouteService $appMenuRouteService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $id,
                             AppMenuRouteService $appMenuRouteService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$appMenuRouteService, 'delete'], compact('id'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
