<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\AdsEvent;
use App\Repositories\AdsEventRepository;
use App\Repositories\Requests\AdsEventRepositoryRequest;
use App\Services\Requests\AdsEventServiceRequest;
use App\Services\Responses\AdsEventServiceResponse;
use App\Services\Responses\AdsEventServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
 * Class AdsEventServiceTrait
 * @package App\Services
 */
trait AdsEventServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(AdsEventServiceRequest $adsEventServiceRequest, AdsEventRepositoryRequest $adsEventRepositoryRequest, AdsEventRepository $adsEventRepository, AdsEventServiceResponse $adsEventServiceResponse): AdsEventServiceResponse
    {
        $adsEventRepositoryRequest = Lazy::transform($adsEventServiceRequest, $adsEventRepositoryRequest);

        $result = app()->call([$adsEventRepository, 'store'], ['adsEventRepositoryRequest' => $adsEventRepositoryRequest]);
        if ($result != null) {
            $adsEventServiceResponse->status = true;
            $adsEventServiceResponse->message = 'Store Data Success';
            $adsEventServiceResponse->adsEvent = $result;
        } else {
            $adsEventServiceResponse->status = false;
            $adsEventServiceResponse->message = 'Store Data Failed';
        }

        return $adsEventServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $adsEventId, AdsEventServiceRequest $adsEventServiceRequest, AdsEventRepositoryRequest $adsEventRepositoryRequest, AdsEventRepository $adsEventRepository, AdsEventServiceResponse $adsEventServiceResponse): AdsEventServiceResponse
    {
        $adsEventRepositoryRequest = Lazy::transform($adsEventServiceRequest, $adsEventRepositoryRequest);

        $result = app()->call([$adsEventRepository, 'update'], ['adsEventId' => $adsEventId, 'adsEventRepositoryRequest' => $adsEventRepositoryRequest]);
        if ($result != null) {
            $adsEventServiceResponse->status = true;
            $adsEventServiceResponse->message = 'Update Data Success';
            $adsEventServiceResponse->adsEvent = $result;
        } else {
            $adsEventServiceResponse->status = false;
            $adsEventServiceResponse->message = 'Update Data Failed';
        }

        return $adsEventServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $adsEventId, AdsEventRepository $adsEventRepository, AdsEventServiceResponse $adsEventServiceResponse): AdsEventServiceResponse
    {
        $status = app()->call([$adsEventRepository, 'delete'], compact('adsEventId'));
        $adsEventServiceResponse->status = $status;
        if($status){
            $adsEventServiceResponse->message = "Delete Success";
        }else{
            $adsEventServiceResponse->message = "Delete Failed";
        }

        return $adsEventServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param AdsEventServiceResponseList $adsEventServiceResponseList
     * @return AdsEventServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, AdsEventServiceResponseList $adsEventServiceResponseList): AdsEventServiceResponseList{
        if (count($result) > 0) {
            $adsEventServiceResponseList->status = true;
            $adsEventServiceResponseList->message = 'Data Found';
            $adsEventServiceResponseList->adsEventList = $result;
            $adsEventServiceResponseList->count = $result->total();
            $adsEventServiceResponseList->countFiltered = $result->count();
        } else {
            $adsEventServiceResponseList->status = false;
            $adsEventServiceResponseList->message = 'Data Not Found';
        }
        return $adsEventServiceResponseList;
    }

    /**
     * @param AdsEvent|null $adsEvent
     * @param AdsEventServiceResponse $adsEventServiceResponse
     * @return AdsEventServiceResponse
     */
    private function formatResult(?AdsEvent $adsEvent, AdsEventServiceResponse $adsEventServiceResponse): AdsEventServiceResponse{
        if($adsEvent == null){
            $adsEventServiceResponse->status = false;
            $adsEventServiceResponse->message = "Data Not Found";
        }else{
            $adsEventServiceResponse->status = true;
            $adsEventServiceResponse->message = "Data Found";
            $adsEventServiceResponse->adsEvent = $adsEvent;
        }

        return $adsEventServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(AdsEventRepository $adsEventRepository, AdsEventServiceResponseList $adsEventServiceResponseList, int $length = 12, string $q = null): AdsEventServiceResponseList
    {
        $result = app()->call([$adsEventRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $adsEventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(AdsEventRepository $adsEventRepository, string $q = null): int
    {
        return app()->call([$adsEventRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByAdsEventId(int $adsEventId, AdsEventRepository $adsEventRepository, AdsEventServiceResponse $adsEventServiceResponse): AdsEventServiceResponse
    {
        $adsEvent = app()->call([$adsEventRepository, 'getByAdsEventId'], compact('adsEventId'));
        return $this->formatResult($adsEvent, $adsEventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsEventIdList(int $adsEventId, AdsEventRepository $adsEventRepository, AdsEventServiceResponseList $adsEventServiceResponseList, string $q = null,  int $length = 12): AdsEventServiceResponseList
    {
        $adsEvent = app()->call([$adsEventRepository, 'getByAdsEventIdList'], compact('adsEventId', 'length', 'q'));
        return $this->formatResultList($adsEvent, $adsEventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, AdsEventRepository $adsEventRepository, AdsEventServiceResponse $adsEventServiceResponse): AdsEventServiceResponse
    {
        $adsEvent = app()->call([$adsEventRepository, 'getByEventEventId'], compact('eventId'));
        return $this->formatResult($adsEvent, $adsEventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, AdsEventRepository $adsEventRepository, AdsEventServiceResponseList $adsEventServiceResponseList, string $q = null,  int $length = 12): AdsEventServiceResponseList
    {
        $adsEvent = app()->call([$adsEventRepository, 'getByEventEventIdList'], compact('eventId', 'length', 'q'));
        return $this->formatResultList($adsEvent, $adsEventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderAdsOrderId(int $adsOrderId, AdsEventRepository $adsEventRepository, AdsEventServiceResponse $adsEventServiceResponse): AdsEventServiceResponse
    {
        $adsEvent = app()->call([$adsEventRepository, 'getByAdsOrderAdsOrderId'], compact('adsOrderId'));
        return $this->formatResult($adsEvent, $adsEventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderAdsOrderIdList(int $adsOrderId, AdsEventRepository $adsEventRepository, AdsEventServiceResponseList $adsEventServiceResponseList, string $q = null,  int $length = 12): AdsEventServiceResponseList
    {
        $adsEvent = app()->call([$adsEventRepository, 'getByAdsOrderAdsOrderIdList'], compact('adsOrderId', 'length', 'q'));
        return $this->formatResultList($adsEvent, $adsEventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, AdsEventRepository $adsEventRepository, AdsEventServiceResponse $adsEventServiceResponse): AdsEventServiceResponse
    {
        $adsEvent = app()->call([$adsEventRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($adsEvent, $adsEventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, AdsEventRepository $adsEventRepository, AdsEventServiceResponseList $adsEventServiceResponseList, string $q = null,  int $length = 12): AdsEventServiceResponseList
    {
        $adsEvent = app()->call([$adsEventRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($adsEvent, $adsEventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, AdsEventRepository $adsEventRepository, AdsEventServiceResponse $adsEventServiceResponse): AdsEventServiceResponse
    {
        $adsEvent = app()->call([$adsEventRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($adsEvent, $adsEventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, AdsEventRepository $adsEventRepository, AdsEventServiceResponseList $adsEventServiceResponseList, string $q = null,  int $length = 12): AdsEventServiceResponseList
    {
        $adsEvent = app()->call([$adsEventRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($adsEvent, $adsEventServiceResponseList);
    }

}
