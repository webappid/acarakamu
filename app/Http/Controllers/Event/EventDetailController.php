<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\Event;

use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\AppMenuCategoryMenuResponse;
use App\Responses\AppMenuCategoryResponse;
use App\Responses\AppMenuResponse;
use App\Responses\AppMenuRouteResponse;
use App\Responses\AppRoleMenuResponse;
use App\Responses\AppRoleRouteResponse;
use App\Responses\AppRouteResponse;
use App\Responses\AppSettingResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\EventResponse;
use App\Responses\SecurityLevelResponse;
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
use App\Services\EventService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:06
 * Time: 2021/11/06
 * Class EventDetailController
 * @package App\Http\Controllers\Event
 */
class EventDetailController
{

    /**
     * @OA\Get(
     *      path="/api/event/{eventId}/detail",
     *      tags={"Event"},
     *      summary="Get Event Detail",
     *      description="Returns Event Detail",
     *      @OA\Parameter(
     *          name="eventId",
     *          description="Event eventId",
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
     * Returns Event Detail
     */

    /**
     * @param int $eventId
     * @param EventService $eventService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $eventId,
                             EventService $eventService,
                             EventResponse $eventResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventService, 'getByEventId'], compact('eventId'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->event, $eventResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
