<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AppRoutes;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryMenuService;
use App\Services\AppMenuCategoryService;
use App\Services\AppMenuRouteService;
use App\Services\AppMenuService;
use App\Services\AppRoleMenuService;
use App\Services\AppRoleRouteService;
use App\Services\AppRouteService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:02
 * Time: 2021/11/06
 * Class AppRouteDeleteController
 * @package App\Http\Controllers\AppRoutes
 */
class AppRouteDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/app-route/{name}/delete",
     *      tags={"App Route"},
     *      summary="Get App Route List",
     *      description="Returns App Route List",
     *      @OA\Parameter(
     *          name="name",
     *          description="App Route name",
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
     * Returns App Route List
     */
    /**
     * @param string $name
     * @param AppRouteService $appRouteService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(string $name,
                             AppRouteService $appRouteService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$appRouteService, 'delete'], compact('name'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
