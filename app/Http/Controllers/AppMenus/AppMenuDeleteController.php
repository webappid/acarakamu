<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\AppMenus;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryMenuService;
use App\Services\AppMenuCategoryService;
use App\Services\AppMenuRouteService;
use App\Services\AppMenuService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Class AppMenuDeleteController
 * @package App\Http\Controllers\AppMenus
 */
class AppMenuDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/app-menu/{name}/delete",
     *      tags={"App Menu"},
     *      summary="Get App Menu List",
     *      description="Returns App Menu List",
     *      @OA\Parameter(
     *          name="name",
     *          description="App Menu name",
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
     * Returns App Menu List
     */
    /**
     * @param string $name
     * @param AppMenuService $appMenuService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(string $name,
                             AppMenuService $appMenuService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$appMenuService, 'delete'], compact('name'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
