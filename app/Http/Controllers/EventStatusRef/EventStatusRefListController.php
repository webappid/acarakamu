<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\EventStatusRef;

use App\Requests\AdsEventSearchRequest;
use App\Requests\AdsOrderDetailSearchRequest;
use App\Requests\AdsOrderSearchRequest;
use App\Requests\AdsRefPriceSearchRequest;
use App\Requests\CategoryRefSearchRequest;
use App\Requests\CityRefSearchRequest;
use App\Requests\EventGallerySearchRequest;
use App\Requests\EventHistorySearchRequest;
use App\Requests\EventMemberLikeSearchRequest;
use App\Requests\EventSearchRequest;
use App\Requests\EventStatusRefSearchRequest;
use App\Requests\SecurityLevelSearchRequest;
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
 * Class EventStatusRefListController
 * @package App\Http\Controllers\EventStatusRef
 */
class EventStatusRefListController
{
    /**
     * @OA\Get(
     *      path="/api/event-status-ref/list",
     *      tags={"Event Status Ref"},
     *      summary="Get Event Status Ref List",
     *      description="Returns Event Status Ref List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Event Status Ref q",
     *          in="query",
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
     * Returns Event Status Ref List
     */
    public function __invoke(
                             EventStatusRefSearchRequest $eventStatusRefSearchRequest,
                             EventStatusRefService $eventStatusRefService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $eventStatusRefSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$eventStatusRefService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->eventStatusRefList as $item) {
                $data[] = Lazy::transform($item, new EventStatusRefResponse());
            }
        }

        if ($result->status) {
            $response->setData($data);
            $response->setRecordsTotal($result->count);
            $response->setRecordsFiltered($result->countFiltered);
            return $smartResponse->success($response);
        } else {
            return $smartResponse->dataNotFound($response);
        }
    }
}
