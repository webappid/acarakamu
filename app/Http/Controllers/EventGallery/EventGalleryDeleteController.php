<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\EventGallery;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\EventGalleryService;
use App\Services\EventService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:01
 * Time: 2022/09/14
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
    public function __invoke(int $eventGalleryId,
                             EventGalleryService $eventGalleryService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventGalleryService, 'delete'], compact('eventGalleryId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.event-gallery.index'));
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
