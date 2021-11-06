<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsEvent;

use App\Requests\AdsEventSearchRequest;
use App\Requests\SecurityLevelSearchRequest;
use App\Responses\AdsEventResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:54
 * Time: 2021/11/06
 * Class AdsEventListController
 * @package App\Http\Controllers\AdsEvent
 */
class AdsEventListController
{
    /**
     * @OA\Get(
     *      path="/api/ads-event/list",
     *      tags={"Ads Event"},
     *      summary="Get Ads Event List",
     *      description="Returns Ads Event List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Ads Event q",
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
     * Returns Ads Event List
     */
    /**
     * @param AdsEventSearchRequest $adsEventSearchRequest
     * @param AdsEventService $adsEventService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             AdsEventSearchRequest $adsEventSearchRequest,
                             AdsEventService $adsEventService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $adsEventSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$adsEventService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->adsEventList as $item) {
                    $data[] = Lazy::transform($item, new AdsEventResponse());
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
