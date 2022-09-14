<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsOrder;

use App\Requests\AdsEventSearchRequest;
use App\Requests\AdsOrderSearchRequest;
use App\Requests\SecurityLevelSearchRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
 * Class AdsOrderListController
 * @package App\Http\Controllers\AdsOrder
 */
class AdsOrderListController
{
    /**
     * @OA\Get(
     *      path="/api/ads-order/list",
     *      tags={"Ads Order"},
     *      summary="Get Ads Order List",
     *      description="Returns Ads Order List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Ads Order q",
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
     * Returns Ads Order List
     */
    public function __invoke(
                             AdsOrderSearchRequest $adsOrderSearchRequest,
                             AdsOrderService $adsOrderService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $adsOrderSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$adsOrderService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->adsOrderList as $item) {
                $data[] = Lazy::transform($item, new AdsOrderResponse());
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
