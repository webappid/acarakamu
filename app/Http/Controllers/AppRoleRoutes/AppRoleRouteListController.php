<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\AppRoleRoutes;

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
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:01
 * Time: 2021/11/06
 * Class AppRoleRouteListController
 * @package App\Http\Controllers\AppRoleRoutes
 */
class AppRoleRouteListController
{
    /**
     * @OA\Get(
     *      path="/api/app-role-route/list",
     *      tags={"App Role Route"},
     *      summary="Get App Role Route List",
     *      description="Returns App Role Route List",
     *      @OA\Parameter(
     *          name="q",
     *          description="App Role Route q",
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
     * Returns App Role Route List
     */
    /**
     * @param AppRoleRouteSearchRequest $appRoleRouteSearchRequest
     * @param AppRoleRouteService $appRoleRouteService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(
                             AppRoleRouteSearchRequest $appRoleRouteSearchRequest,
                             AppRoleRouteService $appRoleRouteService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $searchValue = $appRoleRouteSearchRequest->validated();
        $q = "";

        if(!empty($searchValue)) {
            $q = $searchValue['q'] ?? "";
        }

        $result = app()->call([$appRoleRouteService, 'get'], ['q' => $q]);

        $data = [];
        if($result->status){
            foreach ($result->appRoleRouteList as $item) {
                    $data[] = Lazy::transform($item, new AppRoleRouteResponse());
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
