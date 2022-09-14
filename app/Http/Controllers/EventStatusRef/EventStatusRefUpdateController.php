<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\EventStatusRef;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\CategoryRefRequest;
use App\Requests\CityRefRequest;
use App\Requests\EventGalleryRequest;
use App\Requests\EventHistoryRequest;
use App\Requests\EventMemberLikeRequest;
use App\Requests\EventRequest;
use App\Requests\EventStatusRefRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\EventGalleryResponse;
use App\Responses\EventHistoryResponse;
use App\Responses\EventMemberLikeResponse;
use App\Responses\EventResponse;
use App\Responses\EventStatusRefResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\EventGalleryService;
use App\Services\EventHistoryService;
use App\Services\EventMemberLikeService;
use App\Services\EventService;
use App\Services\EventStatusRefService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Requests\EventGalleryServiceRequest;
use App\Services\Requests\EventHistoryServiceRequest;
use App\Services\Requests\EventMemberLikeServiceRequest;
use App\Services\Requests\EventServiceRequest;
use App\Services\Requests\EventStatusRefServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:04
 * Time: 2022/09/14
 * Class EventStatusRefUpdateController
 * @package App\Http\Controllers\EventStatusRef
 */
class EventStatusRefUpdateController
{
/**
     * @OA\Put(
     *      path="/api/event-status-ref/{eventStatusId}/update",
     *      tags={"Event Status Ref"},
     *      summary="Store Event Status Ref Data",
     *      description="Store Event Status Ref Data",
     *      @OA\Parameter(
     *          name="eventStatusId",
     *          description="Event Status Ref eventStatusId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventStatusNama",
     *          in="query",
     *          required=true,
     *          description="EventStatusRef eventStatusNama",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventStatusDateChange",
     *          in="query",
     *          required=true,
     *          description="EventStatusRef eventStatusDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventStatusUserId",
     *          in="query",
     *          required=true,
     *          description="EventStatusRef eventStatusUserId",
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
     * Returns Event Status Ref Update status
     */

    public function __invoke(int $eventStatusId,
                             EventStatusRefRequest $eventStatusRefRequest,
                             EventStatusRefServiceRequest $eventStatusRefServiceRequest,
                             EventStatusRefService $eventStatusRefService,
                             EventStatusRefResponse $eventStatusRefResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $eventStatusRefValidated = $eventStatusRefRequest->validated();

        $eventStatusRefServiceRequest = Lazy::copyFromArray($eventStatusRefValidated, $eventStatusRefServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$eventStatusRefService, 'update'], ['eventStatusId' => $eventStatusId, 'eventStatusRefServiceRequest' => $eventStatusRefServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event-status-ref.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->eventStatusRef, $eventStatusRefResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event-status-ref.edit', array_merge(['eventStatusId' => $eventStatusId], request()->query->all())));
            }
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
