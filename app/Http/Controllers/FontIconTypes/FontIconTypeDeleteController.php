<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\FontIconTypes;

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
use App\Services\AppSettingService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\EventGalleryService;
use App\Services\EventHistoryService;
use App\Services\EventMemberLikeService;
use App\Services\EventService;
use App\Services\EventStatusRefService;
use App\Services\EventWishService;
use App\Services\FailedJobService;
use App\Services\FontIconTypeService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:13
 * Time: 2021/11/06
 * Class FontIconTypeDeleteController
 * @package App\Http\Controllers\FontIconTypes
 */
class FontIconTypeDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/font-icon-type/{name}/delete",
     *      tags={"Font Icon Type"},
     *      summary="Get Font Icon Type List",
     *      description="Returns Font Icon Type List",
     *      @OA\Parameter(
     *          name="name",
     *          description="Font Icon Type name",
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
     * Returns Font Icon Type List
     */
    /**
     * @param string $name
     * @param FontIconTypeService $fontIconTypeService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(string $name,
                             FontIconTypeService $fontIconTypeService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$fontIconTypeService, 'delete'], compact('name'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
