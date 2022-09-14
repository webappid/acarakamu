<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\PersonalAccessTokens;

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
use App\Services\SecurityLevelService;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;
use WebAppId\User\Services\PermissionService;

/**
 * @author: 
 * Date: 16:04:18
 * Time: 2022/09/14
 * Class PersonalAccessTokenDeleteController
 * @package App\Http\Controllers\PersonalAccessTokens
 */
class PersonalAccessTokenDeleteController
{
    /**
     * @OA\Delete(
     *      path="/api/personal-access-token/{token}/delete",
     *      tags={"Personal Access Token"},
     *      summary="Get Personal Access Token List",
     *      description="Returns Personal Access Token List",
     *      @OA\Parameter(
     *          name="token",
     *          description="Personal Access Token token",
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
     * Returns Personal Access Token List
     */
    public function __invoke(string $token,
                             PersonalAccessTokenService $personalAccessTokenService,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $result = app()->call([$personalAccessTokenService, 'delete'], compact('token'));

        if (!request()->wantsJson()) {
            $response->setRedirect(route('lazy.personal-access-token.index'));
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
