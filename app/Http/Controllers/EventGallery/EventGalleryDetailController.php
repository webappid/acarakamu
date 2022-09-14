<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\EventGallery;

use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\EventGalleryResponse;
use App\Responses\EventResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\EventGalleryService;
use App\Services\EventService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:01
 * Time: 2022/09/14
 * Class EventGalleryDetailController
 * @package App\Http\Controllers\EventGallery
 */
class EventGalleryDetailController
{

    /**
     * @OA\Get(
     *      path="/api/event-gallery/{eventGalleryId}/detail",
     *      tags={"Event Gallery"},
     *      summary="Get Event Gallery Detail",
     *      description="Returns Event Gallery Detail",
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
     * Returns Event Gallery Detail
     */
    public function __invoke(int $eventGalleryId,
                             EventGalleryService $eventGalleryService,
                             EventGalleryResponse $eventGalleryResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventGalleryService, 'getByEventGalleryId'], compact('eventGalleryId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->eventGallery, $eventGalleryResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
