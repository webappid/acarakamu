<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\EventMemberLike;

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
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:03
 * Time: 2022/09/14
 * Class EventMemberLikeUpdateController
 * @package App\Http\Controllers\EventMemberLike
 */
class EventMemberLikeUpdateController
{
/**
     * @OA\Put(
     *      path="/api/event-member-like/{eventMemberLikeId}/update",
     *      tags={"Event Member Like"},
     *      summary="Store Event Member Like Data",
     *      description="Store Event Member Like Data",
     *      @OA\Parameter(
     *          name="eventMemberLikeId",
     *          description="Event Member Like eventMemberLikeId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventMemberLikeEventId",
     *          in="query",
     *          required=true,
     *          description="EventMemberLike eventMemberLikeEventId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventMemberLikeMemberId",
     *          in="query",
     *          required=true,
     *          description="EventMemberLike eventMemberLikeMemberId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventMemberLikeStars",
     *          in="query",
     *          required=true,
     *          description="EventMemberLike eventMemberLikeStars",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventMemberLikeDateChange",
     *          in="query",
     *          required=true,
     *          description="EventMemberLike eventMemberLikeDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="eventMemberLikeUserId",
     *          in="query",
     *          required=true,
     *          description="EventMemberLike eventMemberLikeUserId",
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
     * Returns Event Member Like Update status
     */

    public function __invoke(int $eventMemberLikeId,
                             EventMemberLikeRequest $eventMemberLikeRequest,
                             EventMemberLikeServiceRequest $eventMemberLikeServiceRequest,
                             EventMemberLikeService $eventMemberLikeService,
                             EventMemberLikeResponse $eventMemberLikeResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $eventMemberLikeValidated = $eventMemberLikeRequest->validated();

        $eventMemberLikeServiceRequest = Lazy::copyFromArray($eventMemberLikeValidated, $eventMemberLikeServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$eventMemberLikeService, 'update'], ['eventMemberLikeId' => $eventMemberLikeId, 'eventMemberLikeServiceRequest' => $eventMemberLikeServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event-member-like.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->eventMemberLike, $eventMemberLikeResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.event-member-like.edit', array_merge(['eventMemberLikeId' => $eventMemberLikeId], request()->query->all())));
            }
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
