<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AdsOrder;
use App\Repositories\AdsOrderRepository;
use App\Repositories\Requests\AdsOrderRepositoryRequest;
use App\Services\Requests\AdsOrderServiceRequest;
use App\Services\Responses\AdsOrderServiceResponse;
use App\Services\Responses\AdsOrderServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
 * Class AdsOrderServiceTrait
 * @package App\Services
 */
trait AdsOrderServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AdsOrderServiceRequest $adsOrderServiceRequest, AdsOrderRepositoryRequest $adsOrderRepositoryRequest, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponse $adsOrderServiceResponse): AdsOrderServiceResponse
    {
        $adsOrderRepositoryRequest = Lazy::transform($adsOrderServiceRequest, $adsOrderRepositoryRequest);

        $result = app()->call([$adsOrderRepository, 'store'], ['adsOrderRepositoryRequest' => $adsOrderRepositoryRequest]);
        if ($result != null) {
            $adsOrderServiceResponse->status = true;
            $adsOrderServiceResponse->message = 'Store Data Success';
            $adsOrderServiceResponse->adsOrder = $result;
        } else {
            $adsOrderServiceResponse->status = false;
            $adsOrderServiceResponse->message = 'Store Data Failed';
        }

        return $adsOrderServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $adsOrderId, AdsOrderServiceRequest $adsOrderServiceRequest, AdsOrderRepositoryRequest $adsOrderRepositoryRequest, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponse $adsOrderServiceResponse): AdsOrderServiceResponse
    {
        $adsOrderRepositoryRequest = Lazy::transform($adsOrderServiceRequest, $adsOrderRepositoryRequest);

        $result = app()->call([$adsOrderRepository, 'update'], ['adsOrderId' => $adsOrderId, 'adsOrderRepositoryRequest' => $adsOrderRepositoryRequest]);
        if ($result != null) {
            $adsOrderServiceResponse->status = true;
            $adsOrderServiceResponse->message = 'Update Data Success';
            $adsOrderServiceResponse->adsOrder = $result;
        } else {
            $adsOrderServiceResponse->status = false;
            $adsOrderServiceResponse->message = 'Update Data Failed';
        }

        return $adsOrderServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $adsOrderId, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponse $adsOrderServiceResponse): AdsOrderServiceResponse
    {
        $status = app()->call([$adsOrderRepository, 'delete'], compact('adsOrderId'));
        $adsOrderServiceResponse->status = $status;
        if($status){
            $adsOrderServiceResponse->message = "Delete Success";
        }else{
            $adsOrderServiceResponse->message = "Delete Failed";
        }

        return $adsOrderServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AdsOrderServiceResponseList $adsOrderServiceResponseList
     * @return AdsOrderServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AdsOrderServiceResponseList $adsOrderServiceResponseList): AdsOrderServiceResponseList{
        if (count($result) > 0) {
            $adsOrderServiceResponseList->status = true;
            $adsOrderServiceResponseList->message = 'Data Found';
            $adsOrderServiceResponseList->adsOrderList = $result;
            $adsOrderServiceResponseList->count = $result->total();
            $adsOrderServiceResponseList->countFiltered = $result->count();
        } else {
            $adsOrderServiceResponseList->status = false;
            $adsOrderServiceResponseList->message = 'Data Not Found';
        }
        return $adsOrderServiceResponseList;
    }

    /**
     * @param AdsOrder|null $adsOrder
     * @param AdsOrderServiceResponse $adsOrderServiceResponse
     * @return AdsOrderServiceResponse
     */
    private function formatResult(?AdsOrder $adsOrder, AdsOrderServiceResponse $adsOrderServiceResponse): AdsOrderServiceResponse{
        if($adsOrder == null){
            $adsOrderServiceResponse->status = false;
            $adsOrderServiceResponse->message = "Data Not Found";
        }else{
            $adsOrderServiceResponse->status = true;
            $adsOrderServiceResponse->message = "Data Found";
            $adsOrderServiceResponse->adsOrder = $adsOrder;
        }

        return $adsOrderServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponseList $adsOrderServiceResponseList, int $length = 12, string $q = null): AdsOrderServiceResponseList
    {
        $result = app()->call([$adsOrderRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $adsOrderServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AdsOrderRepository $adsOrderRepository, string $q = null): int
    {
        return app()->call([$adsOrderRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByAdsOrderId(int $adsOrderId, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponse $adsOrderServiceResponse): AdsOrderServiceResponse
    {
        $adsOrder = app()->call([$adsOrderRepository, 'getByAdsOrderId'], compact('adsOrderId'));
        return $this->formatResult($adsOrder, $adsOrderServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderIdList(int $adsOrderId, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponseList $adsOrderServiceResponseList, string $q = null,  int $length = 12): AdsOrderServiceResponseList
    {
        $adsOrder = app()->call([$adsOrderRepository, 'getByAdsOrderIdList'], compact('adsOrderId', 'length', 'q'));
        return $this->formatResultList($adsOrder, $adsOrderServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponse $adsOrderServiceResponse): AdsOrderServiceResponse
    {
        $adsOrder = app()->call([$adsOrderRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($adsOrder, $adsOrderServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponseList $adsOrderServiceResponseList, string $q = null,  int $length = 12): AdsOrderServiceResponseList
    {
        $adsOrder = app()->call([$adsOrderRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($adsOrder, $adsOrderServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponse $adsOrderServiceResponse): AdsOrderServiceResponse
    {
        $adsOrder = app()->call([$adsOrderRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($adsOrder, $adsOrderServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponseList $adsOrderServiceResponseList, string $q = null,  int $length = 12): AdsOrderServiceResponseList
    {
        $adsOrder = app()->call([$adsOrderRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($adsOrder, $adsOrderServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusId(int $orderStatusId, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponse $adsOrderServiceResponse): AdsOrderServiceResponse
    {
        $adsOrder = app()->call([$adsOrderRepository, 'getByOrderStatusOrderStatusId'], compact('orderStatusId'));
        return $this->formatResult($adsOrder, $adsOrderServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusIdList(int $orderStatusId, AdsOrderRepository $adsOrderRepository, AdsOrderServiceResponseList $adsOrderServiceResponseList, string $q = null,  int $length = 12): AdsOrderServiceResponseList
    {
        $adsOrder = app()->call([$adsOrderRepository, 'getByOrderStatusOrderStatusIdList'], compact('orderStatusId', 'length', 'q'));
        return $this->formatResultList($adsOrder, $adsOrderServiceResponseList);
    }

}
