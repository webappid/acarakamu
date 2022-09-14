<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\EventStatusRef;
use App\Repositories\EventStatusRefRepository;
use App\Repositories\Requests\EventStatusRefRepositoryRequest;
use App\Services\Requests\EventStatusRefServiceRequest;
use App\Services\Responses\EventStatusRefServiceResponse;
use App\Services\Responses\EventStatusRefServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:04
 * Time: 2022/09/14
 * Class EventStatusRefServiceTrait
 * @package App\Services
 */
trait EventStatusRefServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(EventStatusRefServiceRequest $eventStatusRefServiceRequest, EventStatusRefRepositoryRequest $eventStatusRefRepositoryRequest, EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponse $eventStatusRefServiceResponse): EventStatusRefServiceResponse
    {
        $eventStatusRefRepositoryRequest = Lazy::transform($eventStatusRefServiceRequest, $eventStatusRefRepositoryRequest);

        $result = app()->call([$eventStatusRefRepository, 'store'], ['eventStatusRefRepositoryRequest' => $eventStatusRefRepositoryRequest]);
        if ($result != null) {
            $eventStatusRefServiceResponse->status = true;
            $eventStatusRefServiceResponse->message = 'Store Data Success';
            $eventStatusRefServiceResponse->eventStatusRef = $result;
        } else {
            $eventStatusRefServiceResponse->status = false;
            $eventStatusRefServiceResponse->message = 'Store Data Failed';
        }

        return $eventStatusRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventStatusId, EventStatusRefServiceRequest $eventStatusRefServiceRequest, EventStatusRefRepositoryRequest $eventStatusRefRepositoryRequest, EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponse $eventStatusRefServiceResponse): EventStatusRefServiceResponse
    {
        $eventStatusRefRepositoryRequest = Lazy::transform($eventStatusRefServiceRequest, $eventStatusRefRepositoryRequest);

        $result = app()->call([$eventStatusRefRepository, 'update'], ['eventStatusId' => $eventStatusId, 'eventStatusRefRepositoryRequest' => $eventStatusRefRepositoryRequest]);
        if ($result != null) {
            $eventStatusRefServiceResponse->status = true;
            $eventStatusRefServiceResponse->message = 'Update Data Success';
            $eventStatusRefServiceResponse->eventStatusRef = $result;
        } else {
            $eventStatusRefServiceResponse->status = false;
            $eventStatusRefServiceResponse->message = 'Update Data Failed';
        }

        return $eventStatusRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventStatusId, EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponse $eventStatusRefServiceResponse): EventStatusRefServiceResponse
    {
        $status = app()->call([$eventStatusRefRepository, 'delete'], compact('eventStatusId'));
        $eventStatusRefServiceResponse->status = $status;
        if($status){
            $eventStatusRefServiceResponse->message = "Delete Success";
        }else{
            $eventStatusRefServiceResponse->message = "Delete Failed";
        }

        return $eventStatusRefServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param EventStatusRefServiceResponseList $eventStatusRefServiceResponseList
     * @return EventStatusRefServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, EventStatusRefServiceResponseList $eventStatusRefServiceResponseList): EventStatusRefServiceResponseList{
        if (count($result) > 0) {
            $eventStatusRefServiceResponseList->status = true;
            $eventStatusRefServiceResponseList->message = 'Data Found';
            $eventStatusRefServiceResponseList->eventStatusRefList = $result;
            $eventStatusRefServiceResponseList->count = $result->total();
            $eventStatusRefServiceResponseList->countFiltered = $result->count();
        } else {
            $eventStatusRefServiceResponseList->status = false;
            $eventStatusRefServiceResponseList->message = 'Data Not Found';
        }
        return $eventStatusRefServiceResponseList;
    }

    /**
     * @param EventStatusRef|null $eventStatusRef
     * @param EventStatusRefServiceResponse $eventStatusRefServiceResponse
     * @return EventStatusRefServiceResponse
     */
    private function formatResult(?EventStatusRef $eventStatusRef, EventStatusRefServiceResponse $eventStatusRefServiceResponse): EventStatusRefServiceResponse{
        if($eventStatusRef == null){
            $eventStatusRefServiceResponse->status = false;
            $eventStatusRefServiceResponse->message = "Data Not Found";
        }else{
            $eventStatusRefServiceResponse->status = true;
            $eventStatusRefServiceResponse->message = "Data Found";
            $eventStatusRefServiceResponse->eventStatusRef = $eventStatusRef;
        }

        return $eventStatusRefServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponseList $eventStatusRefServiceResponseList, int $length = 12, string $q = null): EventStatusRefServiceResponseList
    {
        $result = app()->call([$eventStatusRefRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $eventStatusRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(EventStatusRefRepository $eventStatusRefRepository, string $q = null): int
    {
        return app()->call([$eventStatusRefRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByEventStatusId(int $eventStatusId, EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponse $eventStatusRefServiceResponse): EventStatusRefServiceResponse
    {
        $eventStatusRef = app()->call([$eventStatusRefRepository, 'getByEventStatusId'], compact('eventStatusId'));
        return $this->formatResult($eventStatusRef, $eventStatusRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventStatusIdList(int $eventStatusId, EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponseList $eventStatusRefServiceResponseList, string $q = null,  int $length = 12): EventStatusRefServiceResponseList
    {
        $eventStatusRef = app()->call([$eventStatusRefRepository, 'getByEventStatusIdList'], compact('eventStatusId', 'length', 'q'));
        return $this->formatResultList($eventStatusRef, $eventStatusRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponse $eventStatusRefServiceResponse): EventStatusRefServiceResponse
    {
        $eventStatusRef = app()->call([$eventStatusRefRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($eventStatusRef, $eventStatusRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponseList $eventStatusRefServiceResponseList, string $q = null,  int $length = 12): EventStatusRefServiceResponseList
    {
        $eventStatusRef = app()->call([$eventStatusRefRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($eventStatusRef, $eventStatusRefServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponse $eventStatusRefServiceResponse): EventStatusRefServiceResponse
    {
        $eventStatusRef = app()->call([$eventStatusRefRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($eventStatusRef, $eventStatusRefServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, EventStatusRefRepository $eventStatusRefRepository, EventStatusRefServiceResponseList $eventStatusRefServiceResponseList, string $q = null,  int $length = 12): EventStatusRefServiceResponseList
    {
        $eventStatusRef = app()->call([$eventStatusRefRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($eventStatusRef, $eventStatusRefServiceResponseList);
    }

}
