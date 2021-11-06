<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\SfAccessRef;

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
use App\Services\EventGalleryService;
use App\Services\EventHistoryService;
use App\Services\EventMemberLikeService;
use App\Services\EventService;
use App\Services\EventStatusRefService;
use App\Services\EventWishService;
use App\Services\FailedJobService;
use App\Services\FontIconService;
use App\Services\FontIconTypeService;
use App\Services\ImageService;
use App\Services\MemberInterestService;
use App\Services\MemberService;
use App\Services\MigrationService;
use App\Services\OrderDetailService;
use App\Services\OrderHistoryStatusService;
use App\Services\OrderService;
use App\Services\OrderStatusService;
use App\Services\PermissionService;
use App\Services\PersonalAccessTokenService;
use App\Services\ProvincesRefService;
use App\Services\RolePermissionService;
use App\Services\SecurityLevelService;
use App\Services\SfAccessRefService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:32
 * Time: 2021/11/06
 * Class SfAccessRefDeleteController
 * @package App\Http\Controllers\SfAccessRef
 */
class SfAccessRefDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/sf-access-ref/{accessId}/delete",
     *      tags={"Sf Access Ref"},
     *      summary="Get Sf Access Ref List",
     *      description="Returns Sf Access Ref List",
     *      @OA\Parameter(
     *          name="accessId",
     *          description="Sf Access Ref accessId",
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
     * Returns Sf Access Ref List
     */
    /**
     * @param int $accessId
     * @param SfAccessRefService $sfAccessRefService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $accessId,
                             SfAccessRefService $sfAccessRefService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$sfAccessRefService, 'delete'], compact('accessId'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
