<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsOrderDetail;

use App\Requests\AdsEventSearchRequest;
use App\Requests\AdsOrderDetailSearchRequest;
use App\Requests\AdsOrderSearchRequest;
use App\Requests\SecurityLevelSearchRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:57
 * Time: 2022/09/14
 * Class AdsOrderDetailListController
 * @package App\Http\Controllers\AdsOrderDetail
 */
class AdsOrderDetailListController
{
    /**
     * @OA\Get(
     *      path="/api/ads-order-detail/list",
     *      tags={"Ads Order Detail"},
     *      summary="Get Ads Order Detail List",
     *      description="Returns Ads Order Detail List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Ads Order Detail q",
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
     * Returns Ads Order Detail List
     */
    public function __invoke(
                             AdsOrderDetailSearchRequest $adsOrderDetailSearchRequest,
                             AdsOrderDetailService $adsOrderDetailService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $adsOrderDetailSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$adsOrderDetailService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->adsOrderDetailList as $item) {
                $data[] = Lazy::transform($item, new AdsOrderDetailResponse());
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
