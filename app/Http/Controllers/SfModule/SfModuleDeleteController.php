<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\SfModule;

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
use App\Services\ImageService;
use App\Services\MemberInterestService;
use App\Services\MemberService;
use App\Services\MigrationService;
use App\Services\OrderDetailService;
use App\Services\OrderHistoryStatusService;
use App\Services\OrderService;
use App\Services\OrderStatusService;
use App\Services\PersonalAccessTokenService;
use App\Services\ProvincesRefService;
use App\Services\RolePermissionService;
use App\Services\RoleRouteService;
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
use App\Services\SfMicroprocessRefParamService;
use App\Services\SfMicroprocessRefProcessService;
use App\Services\SfMicroprocessService;
use App\Services\SfModuleService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
use WebAppId\User\Services\PermissionService;
use WebAppId\User\Services\RouteService;

/**
 * @author: 
 * Date: 16:04:40
 * Time: 2022/09/14
 * Class SfModuleDeleteController
 * @package App\Http\Controllers\SfModule
 */
class SfModuleDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/sf-module/{moduleCode}/delete",
     *      tags={"Sf Module"},
     *      summary="Get Sf Module List",
     *      description="Returns Sf Module List",
     *      @OA\Parameter(
     *          name="moduleCode",
     *          description="Sf Module moduleCode",
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
     * Returns Sf Module List
     */
    public function __invoke(string $moduleCode,
                             SfModuleService $sfModuleService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$sfModuleService, 'delete'], compact('moduleCode'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.sf-module.index'));
        }

        if ($result->status) {
            $response->setMessage("Delete Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            $response->setMessage("Delete Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
