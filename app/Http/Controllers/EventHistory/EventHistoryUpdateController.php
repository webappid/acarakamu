<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\EventHistory;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\CategoryRefRequest;
use App\Requests\CityRefRequest;
use App\Requests\EventGalleryRequest;
use App\Requests\EventHistoryRequest;
use App\Requests\EventRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\EventGalleryResponse;
use App\Responses\EventHistoryResponse;
use App\Responses\EventResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\EventGalleryService;
use App\Services\EventHistoryService;
use App\Services\EventService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Requests\EventGalleryServiceRequest;
use App\Services\Requests\EventHistoryServiceRequest;
use App\Services\Requests\EventServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:02
 * Time: 2022/09/14
 * Class EventHistoryUpdateController
 * @package App\Http\Controllers\EventHistory
 */
class EventHistoryUpdateController
{
/**
     * @OA\Put(
     *      path="/api/event-history/{eventHistoryId}/update",
     *      tags={"Event History"},
     *      summary="Store Event History Data",
     *      description="Store Event History Data",
     *      @OA\Parameter(
     *          name="eventHistoryId",
     *          description="Event History eventHistoryId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventHitoryEventId",
     *          in="query",
     *          required=true,
     *          description="EventHistory eventHitoryEventId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventHistoryStatusId",
     *          in="query",
     *          required=true,
     *          description="EventHistory eventHistoryStatusId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventHistoryMessage",
     *          in="query",
     *          required=true,
     *          description="EventHistory eventHistoryMessage",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventHistoryDateTime",
     *          in="query",
     *          required=true,
     *          description="EventHistory eventHistoryDateTime",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventHistoryUserId",
     *          in="query",
     *          required=true,
     *          description="EventHistory eventHistoryUserId",
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
     * Returns Event History Update status
     */

    public function __invoke(int $eventHistoryId,
                             EventHistoryRequest $eventHistoryRequest,
                             EventHistoryServiceRequest $eventHistoryServiceRequest,
                             EventHistoryService $eventHistoryService,
                             EventHistoryResponse $eventHistoryResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $eventHistoryValidated = $eventHistoryRequest->validated();

        $eventHistoryServiceRequest = Lazy::copyFromArray($eventHistoryValidated, $eventHistoryServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$eventHistoryService, 'update'], ['eventHistoryId' => $eventHistoryId, 'eventHistoryServiceRequest' => $eventHistoryServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event-history.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->eventHistory, $eventHistoryResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event-history.edit', array_merge(['eventHistoryId' => $eventHistoryId], request()->query->all())));
            }
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
