<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\EventGallery;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\AppMenuCategoryMenuRequest;
use App\Requests\AppMenuCategoryRequest;
use App\Requests\AppMenuRequest;
use App\Requests\AppMenuRouteRequest;
use App\Requests\AppRoleMenuRequest;
use App\Requests\AppRoleRouteRequest;
use App\Requests\AppRouteRequest;
use App\Requests\AppSettingRequest;
use App\Requests\CategoryRefRequest;
use App\Requests\CityRefRequest;
use App\Requests\EventGalleryRequest;
use App\Requests\EventRequest;
use App\Requests\SecurityLevelRequest;
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
use App\Responses\EventGalleryResponse;
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
use App\Services\EventGalleryService;
use App\Services\EventService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\AppMenuCategoryMenuServiceRequest;
use App\Services\Requests\AppMenuCategoryServiceRequest;
use App\Services\Requests\AppMenuRouteServiceRequest;
use App\Services\Requests\AppMenuServiceRequest;
use App\Services\Requests\AppRoleMenuServiceRequest;
use App\Services\Requests\AppRoleRouteServiceRequest;
use App\Services\Requests\AppRouteServiceRequest;
use App\Services\Requests\AppSettingServiceRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Requests\EventGalleryServiceRequest;
use App\Services\Requests\EventServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:07
 * Time: 2021/11/06
 * Class EventGalleryStoreController
 * @package App\Http\Controllers\EventGallery
 */
class EventGalleryStoreController
{
/**
     * @OA\Post(
     *      path="/api/event-gallery/store",
     *      tags={"Event Gallery"},
     *      summary="Store Event Gallery Data",
     *      description="Store Event Gallery Data",
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
     * Returns Event Gallery Store status
     */
    /**
     * @param EventGalleryRequest $eventGalleryRequest
     * @param EventGalleryServiceRequest $eventGalleryServiceRequest
     * @param EventGalleryService $eventGalleryService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws Exception
     */
    public function __invoke(EventGalleryRequest $eventGalleryRequest,
                             EventGalleryServiceRequest $eventGalleryServiceRequest,
                             EventGalleryService $eventGalleryService,
                             EventGalleryResponse $eventGalleryResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $eventGalleryValidated = $eventGalleryRequest->validated();

        $eventGalleryServiceRequest = Lazy::copyFromArray($eventGalleryValidated, $eventGalleryServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$eventGalleryService, 'store'], ['eventGalleryServiceRequest' => $eventGalleryServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->eventGallery, $eventGalleryResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            return $smartResponse->saveDataFailed($response);
        }
    }
}
