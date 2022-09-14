<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\SfMicroprocess;

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
use App\Services\SfMicroprocessService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
use WebAppId\User\Services\PermissionService;
use WebAppId\User\Services\RouteService;

/**
 * @author: 
 * Date: 16:04:33
 * Time: 2022/09/14
 * Class SfMicroprocessDeleteController
 * @package App\Http\Controllers\SfMicroprocess
 */
class SfMicroprocessDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/sf-microprocess/{microprocessCode}/delete",
     *      tags={"Sf Microprocess"},
     *      summary="Get Sf Microprocess List",
     *      description="Returns Sf Microprocess List",
     *      @OA\Parameter(
     *          name="microprocessCode",
     *          description="Sf Microprocess microprocessCode",
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
     * Returns Sf Microprocess List
     */
    public function __invoke(string $microprocessCode,
                             SfMicroprocessService $sfMicroprocessService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$sfMicroprocessService, 'delete'], compact('microprocessCode'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.sf-microprocess.index'));
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
