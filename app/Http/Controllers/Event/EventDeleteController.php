<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\Event;

use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\EventService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:00
 * Time: 2022/09/14
 * Class EventDeleteController
 * @package App\Http\Controllers\Event
 */
class EventDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/event/{eventId}/delete",
     *      tags={"Event"},
     *      summary="Get Event List",
     *      description="Returns Event List",
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
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns Event List
     */
    public function __invoke(int $eventId,
                             EventService $eventService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventService, 'delete'], compact('eventId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.event.index'));
        }

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
