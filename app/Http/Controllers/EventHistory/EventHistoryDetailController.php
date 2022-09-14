<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\EventHistory;

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
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:02
 * Time: 2022/09/14
 * Class EventHistoryDetailController
 * @package App\Http\Controllers\EventHistory
 */
class EventHistoryDetailController
{

    /**
     * @OA\Get(
     *      path="/api/event-history/{eventHistoryId}/detail",
     *      tags={"Event History"},
     *      summary="Get Event History Detail",
     *      description="Returns Event History Detail",
     *      @OA\Parameter(
     *          name="eventHistoryId",
     *          description="Event History eventHistoryId",
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
     * Returns Event History Detail
     */
    public function __invoke(int $eventHistoryId,
                             EventHistoryService $eventHistoryService,
                             EventHistoryResponse $eventHistoryResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventHistoryService, 'getByEventHistoryId'], compact('eventHistoryId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->eventHistory, $eventHistoryResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
