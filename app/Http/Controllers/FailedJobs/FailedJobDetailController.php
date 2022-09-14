<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\FailedJobs;

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
use App\Responses\EventWishResponse;
use App\Responses\FailedJobResponse;
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
use App\Services\EventWishService;
use App\Services\FailedJobService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:04:07
 * Time: 2022/09/14
 * Class FailedJobDetailController
 * @package App\Http\Controllers\FailedJobs
 */
class FailedJobDetailController
{

    /**
     * @OA\Get(
     *      path="/api/failed-job/{uuid}/detail",
     *      tags={"Failed Job"},
     *      summary="Get Failed Job Detail",
     *      description="Returns Failed Job Detail",
     *      @OA\Parameter(
     *          name="uuid",
     *          description="Failed Job uuid",
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
     * Returns Failed Job Detail
     */
    public function __invoke(string $uuid,
                             FailedJobService $failedJobService,
                             FailedJobResponse $failedJobResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$failedJobService, 'getByUuid'], compact('uuid'));

        if ($result->status) {
            $response->setData(Lazy::transform($result->failedJob, $failedJobResponse));
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
