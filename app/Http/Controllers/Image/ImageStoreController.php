<?php
/**
* Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
*/
namespace App\Http\Controllers\Image;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\AppMenuCategoryMenuRequest;
use App\Requests\AppMenuCategoryRequest;
use App\Requests\AppMenuRequest;
use App\Requests\AppMenuRouteRequest;
use App\Requests\AppRoleMenuRequest;
use App\Requests\AppRoleRouteRequest;
use App\Requests\AppRouteRequest;
use App\Requests\AppSettingRequest;
use App\Requests\CategoryRefRequest;
use App\Requests\CityRefRequest;
use App\Requests\EventGalleryRequest;
use App\Requests\EventHistoryRequest;
use App\Requests\EventMemberLikeRequest;
use App\Requests\EventRequest;
use App\Requests\EventStatusRefRequest;
use App\Requests\EventWishRequest;
use App\Requests\FailedJobRequest;
use App\Requests\FontIconRequest;
use App\Requests\FontIconTypeRequest;
use App\Requests\ImageRequest;
use App\Requests\SecurityLevelRequest;
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
use App\Responses\EventGalleryResponse;
use App\Responses\EventHistoryResponse;
use App\Responses\EventMemberLikeResponse;
use App\Responses\EventResponse;
use App\Responses\EventStatusRefResponse;
use App\Responses\EventWishResponse;
use App\Responses\FailedJobResponse;
use App\Responses\FontIconResponse;
use App\Responses\FontIconTypeResponse;
use App\Responses\ImageResponse;
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
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\AppMenuCategoryMenuServiceRequest;
use App\Services\Requests\AppMenuCategoryServiceRequest;
use App\Services\Requests\AppMenuRouteServiceRequest;
use App\Services\Requests\AppMenuServiceRequest;
use App\Services\Requests\AppRoleMenuServiceRequest;
use App\Services\Requests\AppRoleRouteServiceRequest;
use App\Services\Requests\AppRouteServiceRequest;
use App\Services\Requests\AppSettingServiceRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Requests\EventGalleryServiceRequest;
use App\Services\Requests\EventHistoryServiceRequest;
use App\Services\Requests\EventMemberLikeServiceRequest;
use App\Services\Requests\EventServiceRequest;
use App\Services\Requests\EventStatusRefServiceRequest;
use App\Services\Requests\EventWishServiceRequest;
use App\Services\Requests\FailedJobServiceRequest;
use App\Services\Requests\FontIconServiceRequest;
use App\Services\Requests\FontIconTypeServiceRequest;
use App\Services\Requests\ImageServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use Exception;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 14:04:15
 * Time: 2021/11/06
 * Class ImageStoreController
 * @package App\Http\Controllers\Image
 */
class ImageStoreController
{
/**
     * @OA\Post(
     *      path="/api/image/store",
     *      tags={"Image"},
     *      summary="Store Image Data",
     *      description="Store Image Data",
     *      @OA\Parameter(
     *          name="imageName",
     *          in="query",
     *          required=true,
     *          description="Image imageName",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="imageDescription",
     *          in="query",
     *          required=true,
     *          description="Image imageDescription",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="imageAlt",
     *          in="query",
     *          required=true,
     *          description="Image imageAlt",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="imageOwnerUserId",
     *          in="query",
     *          required=true,
     *          description="Image imageOwnerUserId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="imageDateChange",
     *          in="query",
     *          required=true,
     *          description="Image imageDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="imageUserId",
     *          in="query",
     *          required=true,
     *          description="Image imageUserId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Response(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *          ),
     *          response=201,
     *          description="Store Data Success"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="System error"
     *      ),
     *      security={
     *          {"api_key_security_example": {}}
     *      }
     *      )
     *
     * Returns Image Store status
     */
    /**
     * @param ImageRequest $imageRequest
     * @param ImageServiceRequest $imageServiceRequest
     * @param ImageService $imageService
     * @param SmartResponse $smartResponse
     * @param Response $response
     * @return mixed
     * @throws Exception
     */
    public function __invoke(ImageRequest $imageRequest,
                             ImageServiceRequest $imageServiceRequest,
                             ImageService $imageService,
                             ImageResponse $imageResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $imageValidated = $imageRequest->validated();

        $imageServiceRequest = Lazy::copyFromArray($imageValidated, $imageServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$imageService, 'store'], ['imageServiceRequest' => $imageServiceRequest]);

        if ($result->status) {
            
            $response->setData(Lazy::transform($result->image, $imageResponse));
            return $smartResponse->saveDataSuccess($response);
        } else {
            
            return $smartResponse->saveDataFailed($response);
        }
    }
}
