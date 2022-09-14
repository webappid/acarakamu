<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\Event;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\CategoryRefRequest;
use App\Requests\CityRefRequest;
use App\Requests\EventRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\EventResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\EventService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Requests\EventServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:00
 * Time: 2022/09/14
 * Class EventStoreController
 * @package App\Http\Controllers\Event
 */
class EventStoreController
{
/**
     * @OA\Post(
     *      path="/api/event/store",
     *      tags={"Event"},
     *      summary="Store Event Data",
     *      description="Store Event Data",
     *      @OA\Parameter(
     *          name="eventTitle",
     *          in="query",
     *          required=true,
     *          description="Event eventTitle",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventCoverImageId",
     *          in="query",
     *          required=false,
     *          description="Event eventCoverImageId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventDescription",
     *          in="query",
     *          required=false,
     *          description="Event eventDescription",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventCityId",
     *          in="query",
     *          required=true,
     *          description="Event eventCityId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventAlamatDetil",
     *          in="query",
     *          required=false,
     *          description="Event eventAlamatDetil",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventCategoryId",
     *          in="query",
     *          required=true,
     *          description="Event eventCategoryId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventPrice",
     *          in="query",
     *          required=true,
     *          description="Event eventPrice",
     *          @OA\Schema(
     *              type="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventInfo",
     *          in="query",
     *          required=false,
     *          description="Event eventInfo",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventStatusId",
     *          in="query",
     *          required=true,
     *          description="Event eventStatusId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventDateTimeStart",
     *          in="query",
     *          required=true,
     *          description="Event eventDateTimeStart",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventDateTimeEnd",
     *          in="query",
     *          required=true,
     *          description="Event eventDateTimeEnd",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventDateChange",
     *          in="query",
     *          required=true,
     *          description="Event eventDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventQuota",
     *          in="query",
     *          required=true,
     *          description="Event eventQuota",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventQuotaSisa",
     *          in="query",
     *          required=true,
     *          description="Event eventQuotaSisa",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventGMT",
     *          in="query",
     *          required=true,
     *          description="Event eventGMT",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventOwnerUserId",
     *          in="query",
     *          required=true,
     *          description="Event eventOwnerUserId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventUserId",
     *          in="query",
     *          required=true,
     *          description="Event eventUserId",
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
     * Returns Event Store status
     */
    public function __invoke(EventRequest $eventRequest,
                             EventServiceRequest $eventServiceRequest,
                             EventService $eventService,
                             EventResponse $eventResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $eventValidated = $eventRequest->validated();

        $eventServiceRequest = Lazy::copyFromArray($eventValidated, $eventServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$eventService, 'store'], ['eventServiceRequest' => $eventServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->event, $eventResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event.create', request()->query->all()));
            }
            return $smartResponse->saveDataFailed($response);
        }
    }
}
