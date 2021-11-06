<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\EventGallery;

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
use App\Services\EventService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:07
 * Time: 2021/11/06
 * Class EventGalleryDeleteController
 * @package App\Http\Controllers\EventGallery
 */
class EventGalleryDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/event-gallery/{eventGalleryId}/delete",
     *      tags={"Event Gallery"},
     *      summary="Get Event Gallery List",
     *      description="Returns Event Gallery List",
     *      @OA\Parameter(
     *          name="eventGalleryId",
     *          description="Event Gallery eventGalleryId",
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
     * Returns Event Gallery List
     */
    /**
     * @param int $eventGalleryId
     * @param EventGalleryService $eventGalleryService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $eventGalleryId,
                             EventGalleryService $eventGalleryService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventGalleryService, 'delete'], compact('eventGalleryId'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
