<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\CityRef;

use App\Requests\AdsEventSearchRequest;
use App\Requests\AdsOrderDetailSearchRequest;
use App\Requests\AdsOrderSearchRequest;
use App\Requests\AdsRefPriceSearchRequest;
use App\Requests\AppMenuCategoryMenuSearchRequest;
use App\Requests\AppMenuCategorySearchRequest;
use App\Requests\AppMenuRouteSearchRequest;
use App\Requests\AppMenuSearchRequest;
use App\Requests\AppRoleMenuSearchRequest;
use App\Requests\AppRoleRouteSearchRequest;
use App\Requests\AppRouteSearchRequest;
use App\Requests\AppSettingSearchRequest;
use App\Requests\CategoryRefSearchRequest;
use App\Requests\CityRefSearchRequest;
use App\Requests\SecurityLevelSearchRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\AppMenuCategoryMenuResponse;
use App\Responses\AppMenuCategoryResponse;
use App\Responses\AppMenuResponse;
use App\Responses\AppMenuRouteResponse;
use App\Responses\AppRoleMenuResponse;
use App\Responses\AppRoleRouteResponse;
use App\Responses\AppRouteResponse;
use App\Responses\AppSettingResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\AppMenuCategoryMenuService;
use App\Services\AppMenuCategoryService;
use App\Services\AppMenuRouteService;
use App\Services\AppMenuService;
use App\Services\AppRoleMenuService;
use App\Services\AppRoleRouteService;
use App\Services\AppRouteService;
use App\Services\AppSettingService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:05
 * Time: 2021/11/06
 * Class CityRefListController
 * @package App\Http\Controllers\CityRef
 */
class CityRefListController
{
    /**
     * @OA\Get(
     *      path="/api/city-ref/list",
     *      tags={"City Ref"},
     *      summary="Get City Ref List",
     *      description="Returns City Ref List",
     *      @OA\Parameter(
     *          name="q",
     *          description="City Ref q",
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
     * Returns City Ref List
     */
    /**
     * @param CityRefSearchRequest $cityRefSearchRequest
     * @param CityRefService $cityRefService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             CityRefSearchRequest $cityRefSearchRequest,
                             CityRefService $cityRefService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $cityRefSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$cityRefService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->cityRefList as $item) {
                    $data[] = Lazy::transform($item, new CityRefResponse());
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
