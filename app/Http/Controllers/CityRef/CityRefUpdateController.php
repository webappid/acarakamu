<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */
namespace App\Http\Controllers\CityRef;

use App\Requests\AdsEventRequest;
use App\Requests\AdsOrderDetailRequest;
use App\Requests\AdsOrderRequest;
use App\Requests\AdsRefPriceRequest;
use App\Requests\CategoryRefRequest;
use App\Requests\CityRefRequest;
use App\Requests\SecurityLevelRequest;
use App\Responses\AdsEventResponse;
use App\Responses\AdsOrderDetailResponse;
use App\Responses\AdsOrderResponse;
use App\Responses\AdsRefPriceResponse;
use App\Responses\CategoryRefResponse;
use App\Responses\CityRefResponse;
use App\Responses\SecurityLevelResponse;
use App\Services\AdsEventService;
use App\Services\AdsOrderDetailService;
use App\Services\AdsOrderService;
use App\Services\AdsRefPriceService;
use App\Services\CategoryRefService;
use App\Services\CityRefService;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Requests\AdsRefPriceServiceRequest;
use App\Services\Requests\CategoryRefServiceRequest;
use App\Services\Requests\CityRefServiceRequest;
use App\Services\Requests\SecurityLevelServiceRequest;
use App\Services\SecurityLevelService;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\SmartResponse\Response;
use WebAppId\SmartResponse\SmartResponse;

/**
 * @author: 
 * Date: 16:03:59
 * Time: 2022/09/14
 * Class CityRefUpdateController
 * @package App\Http\Controllers\CityRef
 */
class CityRefUpdateController
{
/**
     * @OA\Put(
     *      path="/api/city-ref/{cityId}/update",
     *      tags={"City Ref"},
     *      summary="Store City Ref Data",
     *      description="Store City Ref Data",
     *      @OA\Parameter(
     *          name="cityId",
     *          description="City Ref cityId",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="cityProvincesRefId",
     *          in="query",
     *          required=true,
     *          description="CityRef cityProvincesRefId",
     *          @OA\Schema(
     *              type="int"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="cityNama",
     *          in="query",
     *          required=true,
     *          description="CityRef cityNama",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="cityStatusAktif",
     *          in="query",
     *          required=true,
     *          description="CityRef cityStatusAktif",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="cityDateChange",
     *          in="query",
     *          required=true,
     *          description="CityRef cityDateChange",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="cityUserId",
     *          in="query",
     *          required=true,
     *          description="CityRef cityUserId",
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
     * Returns City Ref Update status
     */

    public function __invoke(int $cityId,
                             CityRefRequest $cityRefRequest,
                             CityRefServiceRequest $cityRefServiceRequest,
                             CityRefService $cityRefService,
                             CityRefResponse $cityRefResponse,
                             SmartResponse $smartResponse,
                             Response $response)
    {
        $cityRefValidated = $cityRefRequest->validated();

        $cityRefServiceRequest = Lazy::copyFromArray($cityRefValidated, $cityRefServiceRequest, Lazy::AUTOCAST);

        
        
        $result = app()->call([$cityRefService, 'update'], ['cityId' => $cityId, 'cityRefServiceRequest' => $cityRefServiceRequest]);

        if ($result->status) {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.city-ref.index', request()->query->all()));
            }
            $response->setData(Lazy::transform($result->cityRef, $cityRefResponse));
            $response->setMessage("Update Data Success");
            return $smartResponse->saveDataSuccess($response);
        } else {
            if (!request()->wantsJson()) {
                $response->setRedirect(route('lazy.city-ref.edit', array_merge(['cityId' => $cityId], request()->query->all())));
            }
            $response->setMessage("Update Data Gagal");
            return $smartResponse->saveDataFailed($response);
        }
    }
}
