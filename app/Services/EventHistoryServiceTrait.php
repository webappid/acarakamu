<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\EventHistory;
use App\Repositories\EventHistoryRepository;
use App\Repositories\Requests\EventHistoryRepositoryRequest;
use App\Services\Requests\EventHistoryServiceRequest;
use App\Services\Responses\EventHistoryServiceResponse;
use App\Services\Responses\EventHistoryServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:02
 * Time: 2022/09/14
 * Class EventHistoryServiceTrait
 * @package App\Services
 */
trait EventHistoryServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(EventHistoryServiceRequest $eventHistoryServiceRequest, EventHistoryRepositoryRequest $eventHistoryRepositoryRequest, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponse $eventHistoryServiceResponse): EventHistoryServiceResponse
    {
        $eventHistoryRepositoryRequest = Lazy::transform($eventHistoryServiceRequest, $eventHistoryRepositoryRequest);

        $result = app()->call([$eventHistoryRepository, 'store'], ['eventHistoryRepositoryRequest' => $eventHistoryRepositoryRequest]);
        if ($result != null) {
            $eventHistoryServiceResponse->status = true;
            $eventHistoryServiceResponse->message = 'Store Data Success';
            $eventHistoryServiceResponse->eventHistory = $result;
        } else {
            $eventHistoryServiceResponse->status = false;
            $eventHistoryServiceResponse->message = 'Store Data Failed';
        }

        return $eventHistoryServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventHistoryId, EventHistoryServiceRequest $eventHistoryServiceRequest, EventHistoryRepositoryRequest $eventHistoryRepositoryRequest, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponse $eventHistoryServiceResponse): EventHistoryServiceResponse
    {
        $eventHistoryRepositoryRequest = Lazy::transform($eventHistoryServiceRequest, $eventHistoryRepositoryRequest);

        $result = app()->call([$eventHistoryRepository, 'update'], ['eventHistoryId' => $eventHistoryId, 'eventHistoryRepositoryRequest' => $eventHistoryRepositoryRequest]);
        if ($result != null) {
            $eventHistoryServiceResponse->status = true;
            $eventHistoryServiceResponse->message = 'Update Data Success';
            $eventHistoryServiceResponse->eventHistory = $result;
        } else {
            $eventHistoryServiceResponse->status = false;
            $eventHistoryServiceResponse->message = 'Update Data Failed';
        }

        return $eventHistoryServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventHistoryId, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponse $eventHistoryServiceResponse): EventHistoryServiceResponse
    {
        $status = app()->call([$eventHistoryRepository, 'delete'], compact('eventHistoryId'));
        $eventHistoryServiceResponse->status = $status;
        if($status){
            $eventHistoryServiceResponse->message = "Delete Success";
        }else{
            $eventHistoryServiceResponse->message = "Delete Failed";
        }

        return $eventHistoryServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param EventHistoryServiceResponseList $eventHistoryServiceResponseList
     * @return EventHistoryServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, EventHistoryServiceResponseList $eventHistoryServiceResponseList): EventHistoryServiceResponseList{
        if (count($result) > 0) {
            $eventHistoryServiceResponseList->status = true;
            $eventHistoryServiceResponseList->message = 'Data Found';
            $eventHistoryServiceResponseList->eventHistoryList = $result;
            $eventHistoryServiceResponseList->count = $result->total();
            $eventHistoryServiceResponseList->countFiltered = $result->count();
        } else {
            $eventHistoryServiceResponseList->status = false;
            $eventHistoryServiceResponseList->message = 'Data Not Found';
        }
        return $eventHistoryServiceResponseList;
    }

    /**
     * @param EventHistory|null $eventHistory
     * @param EventHistoryServiceResponse $eventHistoryServiceResponse
     * @return EventHistoryServiceResponse
     */
    private function formatResult(?EventHistory $eventHistory, EventHistoryServiceResponse $eventHistoryServiceResponse): EventHistoryServiceResponse{
        if($eventHistory == null){
            $eventHistoryServiceResponse->status = false;
            $eventHistoryServiceResponse->message = "Data Not Found";
        }else{
            $eventHistoryServiceResponse->status = true;
            $eventHistoryServiceResponse->message = "Data Found";
            $eventHistoryServiceResponse->eventHistory = $eventHistory;
        }

        return $eventHistoryServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponseList $eventHistoryServiceResponseList, int $length = 12, string $q = null): EventHistoryServiceResponseList
    {
        $result = app()->call([$eventHistoryRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $eventHistoryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(EventHistoryRepository $eventHistoryRepository, string $q = null): int
    {
        return app()->call([$eventHistoryRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByEventHistoryId(int $eventHistoryId, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponse $eventHistoryServiceResponse): EventHistoryServiceResponse
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getByEventHistoryId'], compact('eventHistoryId'));
        return $this->formatResult($eventHistory, $eventHistoryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventHistoryIdList(int $eventHistoryId, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponseList $eventHistoryServiceResponseList, string $q = null,  int $length = 12): EventHistoryServiceResponseList
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getByEventHistoryIdList'], compact('eventHistoryId', 'length', 'q'));
        return $this->formatResultList($eventHistory, $eventHistoryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponse $eventHistoryServiceResponse): EventHistoryServiceResponse
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getByEventEventId'], compact('eventId'));
        return $this->formatResult($eventHistory, $eventHistoryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponseList $eventHistoryServiceResponseList, string $q = null,  int $length = 12): EventHistoryServiceResponseList
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getByEventEventIdList'], compact('eventId', 'length', 'q'));
        return $this->formatResultList($eventHistory, $eventHistoryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventStatusRefEventStatusId(int $eventStatusId, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponse $eventHistoryServiceResponse): EventHistoryServiceResponse
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getByEventStatusRefEventStatusId'], compact('eventStatusId'));
        return $this->formatResult($eventHistory, $eventHistoryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventStatusRefEventStatusIdList(int $eventStatusId, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponseList $eventHistoryServiceResponseList, string $q = null,  int $length = 12): EventHistoryServiceResponseList
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getByEventStatusRefEventStatusIdList'], compact('eventStatusId', 'length', 'q'));
        return $this->formatResultList($eventHistory, $eventHistoryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponse $eventHistoryServiceResponse): EventHistoryServiceResponse
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($eventHistory, $eventHistoryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponseList $eventHistoryServiceResponseList, string $q = null,  int $length = 12): EventHistoryServiceResponseList
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($eventHistory, $eventHistoryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponse $eventHistoryServiceResponse): EventHistoryServiceResponse
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($eventHistory, $eventHistoryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, EventHistoryRepository $eventHistoryRepository, EventHistoryServiceResponseList $eventHistoryServiceResponseList, string $q = null,  int $length = 12): EventHistoryServiceResponseList
    {
        $eventHistory = app()->call([$eventHistoryRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($eventHistory, $eventHistoryServiceResponseList);
    }

}
