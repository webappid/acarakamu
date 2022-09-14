<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\EventStatusRef;

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
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:04
 * Time: 2022/09/14
 * Class EventStatusRefDeleteController
 * @package App\Http\Controllers\EventStatusRef
 */
class EventStatusRefDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/event-status-ref/{eventStatusId}/delete",
     *      tags={"Event Status Ref"},
     *      summary="Get Event Status Ref List",
     *      description="Returns Event Status Ref List",
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
     * Returns Event Status Ref List
     */
    public function __invoke(int $eventStatusId,
                             EventStatusRefService $eventStatusRefService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventStatusRefService, 'delete'], compact('eventStatusId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.event-status-ref.index'));
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
