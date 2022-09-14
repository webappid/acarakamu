<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\EventHistory;

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
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:02
 * Time: 2022/09/14
 * Class EventHistoryDeleteController
 * @package App\Http\Controllers\EventHistory
 */
class EventHistoryDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/event-history/{eventHistoryId}/delete",
     *      tags={"Event History"},
     *      summary="Get Event History List",
     *      description="Returns Event History List",
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
     * Returns Event History List
     */
    public function __invoke(int $eventHistoryId,
                             EventHistoryService $eventHistoryService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventHistoryService, 'delete'], compact('eventHistoryId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.event-history.index'));
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
