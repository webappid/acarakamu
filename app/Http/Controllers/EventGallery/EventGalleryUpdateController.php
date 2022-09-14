<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\EventGallery;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\CategoryRefRequest;
use App\Requests\CityRefRequest;
use App\Requests\EventGalleryRequest;
use App\Requests\EventRequest;
use App\Requests\SecurityLevelRequest;
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
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Requests\EventGalleryServiceRequest;
use App\Services\Requests\EventServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:01
 * Time: 2022/09/14
 * Class EventGalleryUpdateController
 * @package App\Http\Controllers\EventGallery
 */
class EventGalleryUpdateController
{
/**
     * @OA\Put(
     *      path="/api/event-gallery/{eventGalleryId}/update",
     *      tags={"Event Gallery"},
     *      summary="Store Event Gallery Data",
     *      description="Store Event Gallery Data",
     *      @OA\Parameter(
     *          name="eventGalleryId",
     *          description="Event Gallery eventGalleryId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventGalleryEventId",
     *          in="query",
     *          required=true,
     *          description="EventGallery eventGalleryEventId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventGalleryImageId",
     *          in="query",
     *          required=true,
     *          description="EventGallery eventGalleryImageId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventGalleryDateChange",
     *          in="query",
     *          required=true,
     *          description="EventGallery eventGalleryDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventGalleryUserId",
     *          in="query",
     *          required=true,
     *          description="EventGallery eventGalleryUserId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=201,
     *          description="Store Data Success"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="System error"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns Event Gallery Update status
     */

    public function __invoke(int $eventGalleryId,
                             EventGalleryRequest $eventGalleryRequest,
                             EventGalleryServiceRequest $eventGalleryServiceRequest,
                             EventGalleryService $eventGalleryService,
                             EventGalleryResponse $eventGalleryResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $eventGalleryValidated = $eventGalleryRequest->validated();

        $eventGalleryServiceRequest = Lazy::copyFromArray($eventGalleryValidated, $eventGalleryServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$eventGalleryService, 'update'], ['eventGalleryId' => $eventGalleryId, 'eventGalleryServiceRequest' => $eventGalleryServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event-gallery.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->eventGallery, $eventGalleryResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event-gallery.edit', array_merge(['eventGalleryId' => $eventGalleryId], request()->query->all())));
            }
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
