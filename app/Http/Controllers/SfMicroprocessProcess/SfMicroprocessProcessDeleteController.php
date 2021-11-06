<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\SfMicroprocessProcess;

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
use App\Services\SfConfigService;
use App\Services\SfGroupMenuService;
use App\Services\SfGroupModuleService;
use App\Services\SfGroupService;
use App\Services\SfLabelService;
use App\Services\SfLanguageService;
use App\Services\SfMenuLanguageService;
use App\Services\SfMenuService;
use App\Services\SfMicroprocessInputService;
use App\Services\SfMicroprocessProcessService;
use App\Services\SfMicroprocessService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:46
 * Time: 2021/11/06
 * Class SfMicroprocessProcessDeleteController
 * @package App\Http\Controllers\SfMicroprocessProcess
 */
class SfMicroprocessProcessDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/sf-microprocess-process/{microprocessProcessId}/delete",
     *      tags={"Sf Microprocess Process"},
     *      summary="Get Sf Microprocess Process List",
     *      description="Returns Sf Microprocess Process List",
     *      @OA\Parameter(
     *          name="microprocessProcessId",
     *          description="Sf Microprocess Process microprocessProcessId",
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
     * Returns Sf Microprocess Process List
     */
    /**
     * @param int $microprocessProcessId
     * @param SfMicroprocessProcessService $sfMicroprocessProcessService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     */
    public function __invoke(int $microprocessProcessId,
                             SfMicroprocessProcessService $sfMicroprocessProcessService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$sfMicroprocessProcessService, 'delete'], compact('microprocessProcessId'));

        

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
