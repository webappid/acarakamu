<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AdsOrderDetail;
use App\Repositories\AdsOrderDetailRepository;
use App\Repositories\Requests\AdsOrderDetailRepositoryRequest;
use App\Services\Requests\AdsOrderDetailServiceRequest;
use App\Services\Responses\AdsOrderDetailServiceResponse;
use App\Services\Responses\AdsOrderDetailServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
 * Class AdsOrderDetailServiceTrait
 * @package App\Services
 */
trait AdsOrderDetailServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AdsOrderDetailServiceRequest $adsOrderDetailServiceRequest, AdsOrderDetailRepositoryRequest $adsOrderDetailRepositoryRequest, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponse $adsOrderDetailServiceResponse): AdsOrderDetailServiceResponse
    {
        $adsOrderDetailRepositoryRequest = Lazy::transform($adsOrderDetailServiceRequest, $adsOrderDetailRepositoryRequest);

        $result = app()->call([$adsOrderDetailRepository, 'store'], ['adsOrderDetailRepositoryRequest' => $adsOrderDetailRepositoryRequest]);
        if ($result != null) {
            $adsOrderDetailServiceResponse->status = true;
            $adsOrderDetailServiceResponse->message = 'Store Data Success';
            $adsOrderDetailServiceResponse->adsOrderDetail = $result;
        } else {
            $adsOrderDetailServiceResponse->status = false;
            $adsOrderDetailServiceResponse->message = 'Store Data Failed';
        }

        return $adsOrderDetailServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $adsOrderDetailId, AdsOrderDetailServiceRequest $adsOrderDetailServiceRequest, AdsOrderDetailRepositoryRequest $adsOrderDetailRepositoryRequest, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponse $adsOrderDetailServiceResponse): AdsOrderDetailServiceResponse
    {
        $adsOrderDetailRepositoryRequest = Lazy::transform($adsOrderDetailServiceRequest, $adsOrderDetailRepositoryRequest);

        $result = app()->call([$adsOrderDetailRepository, 'update'], ['adsOrderDetailId' => $adsOrderDetailId, 'adsOrderDetailRepositoryRequest' => $adsOrderDetailRepositoryRequest]);
        if ($result != null) {
            $adsOrderDetailServiceResponse->status = true;
            $adsOrderDetailServiceResponse->message = 'Update Data Success';
            $adsOrderDetailServiceResponse->adsOrderDetail = $result;
        } else {
            $adsOrderDetailServiceResponse->status = false;
            $adsOrderDetailServiceResponse->message = 'Update Data Failed';
        }

        return $adsOrderDetailServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $adsOrderDetailId, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponse $adsOrderDetailServiceResponse): AdsOrderDetailServiceResponse
    {
        $status = app()->call([$adsOrderDetailRepository, 'delete'], compact('adsOrderDetailId'));
        $adsOrderDetailServiceResponse->status = $status;
        if($status){
            $adsOrderDetailServiceResponse->message = "Delete Success";
        }else{
            $adsOrderDetailServiceResponse->message = "Delete Failed";
        }

        return $adsOrderDetailServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AdsOrderDetailServiceResponseList $adsOrderDetailServiceResponseList
     * @return AdsOrderDetailServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AdsOrderDetailServiceResponseList $adsOrderDetailServiceResponseList): AdsOrderDetailServiceResponseList{
        if (count($result) > 0) {
            $adsOrderDetailServiceResponseList->status = true;
            $adsOrderDetailServiceResponseList->message = 'Data Found';
            $adsOrderDetailServiceResponseList->adsOrderDetailList = $result;
            $adsOrderDetailServiceResponseList->count = $result->total();
            $adsOrderDetailServiceResponseList->countFiltered = $result->count();
        } else {
            $adsOrderDetailServiceResponseList->status = false;
            $adsOrderDetailServiceResponseList->message = 'Data Not Found';
        }
        return $adsOrderDetailServiceResponseList;
    }

    /**
     * @param AdsOrderDetail|null $adsOrderDetail
     * @param AdsOrderDetailServiceResponse $adsOrderDetailServiceResponse
     * @return AdsOrderDetailServiceResponse
     */
    private function formatResult(?AdsOrderDetail $adsOrderDetail, AdsOrderDetailServiceResponse $adsOrderDetailServiceResponse): AdsOrderDetailServiceResponse{
        if($adsOrderDetail == null){
            $adsOrderDetailServiceResponse->status = false;
            $adsOrderDetailServiceResponse->message = "Data Not Found";
        }else{
            $adsOrderDetailServiceResponse->status = true;
            $adsOrderDetailServiceResponse->message = "Data Found";
            $adsOrderDetailServiceResponse->adsOrderDetail = $adsOrderDetail;
        }

        return $adsOrderDetailServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponseList $adsOrderDetailServiceResponseList, int $length = 12, string $q = null): AdsOrderDetailServiceResponseList
    {
        $result = app()->call([$adsOrderDetailRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $adsOrderDetailServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AdsOrderDetailRepository $adsOrderDetailRepository, string $q = null): int
    {
        return app()->call([$adsOrderDetailRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByAdsOrderDetailId(int $adsOrderDetailId, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponse $adsOrderDetailServiceResponse): AdsOrderDetailServiceResponse
    {
        $adsOrderDetail = app()->call([$adsOrderDetailRepository, 'getByAdsOrderDetailId'], compact('adsOrderDetailId'));
        return $this->formatResult($adsOrderDetail, $adsOrderDetailServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderDetailIdList(int $adsOrderDetailId, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponseList $adsOrderDetailServiceResponseList, string $q = null,  int $length = 12): AdsOrderDetailServiceResponseList
    {
        $adsOrderDetail = app()->call([$adsOrderDetailRepository, 'getByAdsOrderDetailIdList'], compact('adsOrderDetailId', 'length', 'q'));
        return $this->formatResultList($adsOrderDetail, $adsOrderDetailServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderAdsOrderId(int $adsOrderId, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponse $adsOrderDetailServiceResponse): AdsOrderDetailServiceResponse
    {
        $adsOrderDetail = app()->call([$adsOrderDetailRepository, 'getByAdsOrderAdsOrderId'], compact('adsOrderId'));
        return $this->formatResult($adsOrderDetail, $adsOrderDetailServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderAdsOrderIdList(int $adsOrderId, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponseList $adsOrderDetailServiceResponseList, string $q = null,  int $length = 12): AdsOrderDetailServiceResponseList
    {
        $adsOrderDetail = app()->call([$adsOrderDetailRepository, 'getByAdsOrderAdsOrderIdList'], compact('adsOrderId', 'length', 'q'));
        return $this->formatResultList($adsOrderDetail, $adsOrderDetailServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponse $adsOrderDetailServiceResponse): AdsOrderDetailServiceResponse
    {
        $adsOrderDetail = app()->call([$adsOrderDetailRepository, 'getByEventEventId'], compact('eventId'));
        return $this->formatResult($adsOrderDetail, $adsOrderDetailServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponseList $adsOrderDetailServiceResponseList, string $q = null,  int $length = 12): AdsOrderDetailServiceResponseList
    {
        $adsOrderDetail = app()->call([$adsOrderDetailRepository, 'getByEventEventIdList'], compact('eventId', 'length', 'q'));
        return $this->formatResultList($adsOrderDetail, $adsOrderDetailServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsRefPriceAdsPriceRefId(int $adsPriceRefId, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponse $adsOrderDetailServiceResponse): AdsOrderDetailServiceResponse
    {
        $adsOrderDetail = app()->call([$adsOrderDetailRepository, 'getByAdsRefPriceAdsPriceRefId'], compact('adsPriceRefId'));
        return $this->formatResult($adsOrderDetail, $adsOrderDetailServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsRefPriceAdsPriceRefIdList(int $adsPriceRefId, AdsOrderDetailRepository $adsOrderDetailRepository, AdsOrderDetailServiceResponseList $adsOrderDetailServiceResponseList, string $q = null,  int $length = 12): AdsOrderDetailServiceResponseList
    {
        $adsOrderDetail = app()->call([$adsOrderDetailRepository, 'getByAdsRefPriceAdsPriceRefIdList'], compact('adsPriceRefId', 'length', 'q'));
        return $this->formatResultList($adsOrderDetail, $adsOrderDetailServiceResponseList);
    }

}
