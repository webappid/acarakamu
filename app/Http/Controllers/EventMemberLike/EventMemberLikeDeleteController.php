<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\EventMemberLike;

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
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:03
 * Time: 2022/09/14
 * Class EventMemberLikeDeleteController
 * @package App\Http\Controllers\EventMemberLike
 */
class EventMemberLikeDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/event-member-like/{eventMemberLikeId}/delete",
     *      tags={"Event Member Like"},
     *      summary="Get Event Member Like List",
     *      description="Returns Event Member Like List",
     *      @OA\Parameter(
     *          name="eventMemberLikeId",
     *          description="Event Member Like eventMemberLikeId",
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
     * Returns Event Member Like List
     */
    public function __invoke(int $eventMemberLikeId,
                             EventMemberLikeService $eventMemberLikeService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventMemberLikeService, 'delete'], compact('eventMemberLikeId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.event-member-like.index'));
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
