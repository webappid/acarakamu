<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\EventWish;

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
use App\Services\EventWishService;
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:06
 * Time: 2022/09/14
 * Class EventWishDeleteController
 * @package App\Http\Controllers\EventWish
 */
class EventWishDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/event-wish/{wishListId}/delete",
     *      tags={"Event Wish"},
     *      summary="Get Event Wish List",
     *      description="Returns Event Wish List",
     *      @OA\Parameter(
     *          name="wishListId",
     *          description="Event Wish wishListId",
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
     * Returns Event Wish List
     */
    public function __invoke(int $wishListId,
                             EventWishService $eventWishService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$eventWishService, 'delete'], compact('wishListId'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.event-wish.index'));
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
