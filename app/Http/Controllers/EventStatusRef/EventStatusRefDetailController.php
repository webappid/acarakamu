<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\EventStatusRef;

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
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:04
 * Time: 2022/09/14
 * Class EventStatusRefDetailController
 * @package App\Http\Controllers\EventStatusRef
 */
class EventStatusRefDetailController
{

    /**
     * @OA\Get(
     *      path="/api/event-status-ref/{eventStatusId}/detail",
     *      tags={"Event Status Ref"},
     *      summary="Get Event Status Ref Detail",
     *      description="Returns Event Status Ref Detail",
     *      @OA\Parameter(
     *          name="eventStatusId",
     *          description="Event Status Ref eventStatusId",
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
     * Returns Event Status Ref Detail
     */
    public function __invoke(int $eventStatusId,
                             EventStatusRefService $eventStatusRefService,
                             EventStatusRefResponse $eventStatusRefResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventStatusRefService, 'getByEventStatusId'], compact('eventStatusId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->eventStatusRef, $eventStatusRefResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
