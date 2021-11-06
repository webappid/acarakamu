<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AdsRefPrice;

use App\Requests\AdsEventSearchRequest;
use App\Requests\AdsOrderDetailSearchRequest;
use App\Requests\AdsOrderSearchRequest;
use App\Requests\AdsRefPriceSearchRequest;
use App\Requests\SecurityLevelSearchRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:03:57
 * Time: 2021/11/06
 * Class AdsRefPriceListController
 * @package App\Http\Controllers\AdsRefPrice
 */
class AdsRefPriceListController
{
    /**
     * @OA\Get(
     *      path="/api/ads-ref-price/list",
     *      tags={"Ads Ref Price"},
     *      summary="Get Ads Ref Price List",
     *      description="Returns Ads Ref Price List",
     *      @OA\Parameter(
     *          name="q",
     *          description="Ads Ref Price q",
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
     * Returns Ads Ref Price List
     */
    /**
     * @param AdsRefPriceSearchRequest $adsRefPriceSearchRequest
     * @param AdsRefPriceService $adsRefPriceService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             AdsRefPriceSearchRequest $adsRefPriceSearchRequest,
                             AdsRefPriceService $adsRefPriceService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $adsRefPriceSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$adsRefPriceService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->adsRefPriceList as $item) {
                    $data[] = Lazy::transform($item, new AdsRefPriceResponse());
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
