<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepository;
use App\Repositories\Requests\EventRepositoryRequest;
use App\Services\Requests\EventServiceRequest;
use App\Services\Responses\EventServiceResponse;
use App\Services\Responses\EventServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:00
 * Time: 2022/09/14
 * Class EventServiceTrait
 * @package App\Services
 */
trait EventServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(EventServiceRequest $eventServiceRequest, EventRepositoryRequest $eventRepositoryRequest, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $eventRepositoryRequest = Lazy::transform($eventServiceRequest, $eventRepositoryRequest);

        $result = app()->call([$eventRepository, 'store'], ['eventRepositoryRequest' => $eventRepositoryRequest]);
        if ($result != null) {
            $eventServiceResponse->status = true;
            $eventServiceResponse->message = 'Store Data Success';
            $eventServiceResponse->event = $result;
        } else {
            $eventServiceResponse->status = false;
            $eventServiceResponse->message = 'Store Data Failed';
        }

        return $eventServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventId, EventServiceRequest $eventServiceRequest, EventRepositoryRequest $eventRepositoryRequest, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $eventRepositoryRequest = Lazy::transform($eventServiceRequest, $eventRepositoryRequest);

        $result = app()->call([$eventRepository, 'update'], ['eventId' => $eventId, 'eventRepositoryRequest' => $eventRepositoryRequest]);
        if ($result != null) {
            $eventServiceResponse->status = true;
            $eventServiceResponse->message = 'Update Data Success';
            $eventServiceResponse->event = $result;
        } else {
            $eventServiceResponse->status = false;
            $eventServiceResponse->message = 'Update Data Failed';
        }

        return $eventServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventId, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $status = app()->call([$eventRepository, 'delete'], compact('eventId'));
        $eventServiceResponse->status = $status;
        if($status){
            $eventServiceResponse->message = "Delete Success";
        }else{
            $eventServiceResponse->message = "Delete Failed";
        }

        return $eventServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param EventServiceResponseList $eventServiceResponseList
     * @return EventServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, EventServiceResponseList $eventServiceResponseList): EventServiceResponseList{
        if (count($result) > 0) {
            $eventServiceResponseList->status = true;
            $eventServiceResponseList->message = 'Data Found';
            $eventServiceResponseList->eventList = $result;
            $eventServiceResponseList->count = $result->total();
            $eventServiceResponseList->countFiltered = $result->count();
        } else {
            $eventServiceResponseList->status = false;
            $eventServiceResponseList->message = 'Data Not Found';
        }
        return $eventServiceResponseList;
    }

    /**
     * @param Event|null $event
     * @param EventServiceResponse $eventServiceResponse
     * @return EventServiceResponse
     */
    private function formatResult(?Event $event, EventServiceResponse $eventServiceResponse): EventServiceResponse{
        if($event == null){
            $eventServiceResponse->status = false;
            $eventServiceResponse->message = "Data Not Found";
        }else{
            $eventServiceResponse->status = true;
            $eventServiceResponse->message = "Data Found";
            $eventServiceResponse->event = $event;
        }

        return $eventServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, int $length = 12, string $q = null): EventServiceResponseList
    {
        $result = app()->call([$eventRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $eventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(EventRepository $eventRepository, string $q = null): int
    {
        return app()->call([$eventRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByEventId(int $eventId, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $event = app()->call([$eventRepository, 'getByEventId'], compact('eventId'));
        return $this->formatResult($event, $eventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventIdList(int $eventId, EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, string $q = null,  int $length = 12): EventServiceResponseList
    {
        $event = app()->call([$eventRepository, 'getByEventIdList'], compact('eventId', 'length', 'q'));
        return $this->formatResultList($event, $eventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $event = app()->call([$eventRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($event, $eventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, string $q = null,  int $length = 12): EventServiceResponseList
    {
        $event = app()->call([$eventRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($event, $eventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $event = app()->call([$eventRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($event, $eventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, string $q = null,  int $length = 12): EventServiceResponseList
    {
        $event = app()->call([$eventRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($event, $eventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventUserIdSfUserUserName(string $userName, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $event = app()->call([$eventRepository, 'getByEventUserIdSfUserUserName'], compact('userName'));
        return $this->formatResult($event, $eventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventUserIdSfUserUserNameList(string $userName, EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, string $q = null,  int $length = 12): EventServiceResponseList
    {
        $event = app()->call([$eventRepository, 'getByEventUserIdSfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($event, $eventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventUserIdSfUserUserId(int $userId, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $event = app()->call([$eventRepository, 'getByEventUserIdSfUserUserId'], compact('userId'));
        return $this->formatResult($event, $eventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventUserIdSfUserUserIdList(int $userId, EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, string $q = null,  int $length = 12): EventServiceResponseList
    {
        $event = app()->call([$eventRepository, 'getByEventUserIdSfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($event, $eventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageId(int $imageId, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $event = app()->call([$eventRepository, 'getByImageImageId'], compact('imageId'));
        return $this->formatResult($event, $eventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageIdList(int $imageId, EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, string $q = null,  int $length = 12): EventServiceResponseList
    {
        $event = app()->call([$eventRepository, 'getByImageImageIdList'], compact('imageId', 'length', 'q'));
        return $this->formatResultList($event, $eventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventStatusRefEventStatusId(int $eventStatusId, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $event = app()->call([$eventRepository, 'getByEventStatusRefEventStatusId'], compact('eventStatusId'));
        return $this->formatResult($event, $eventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventStatusRefEventStatusIdList(int $eventStatusId, EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, string $q = null,  int $length = 12): EventServiceResponseList
    {
        $event = app()->call([$eventRepository, 'getByEventStatusRefEventStatusIdList'], compact('eventStatusId', 'length', 'q'));
        return $this->formatResultList($event, $eventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryRefCategoryId(int $categoryId, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $event = app()->call([$eventRepository, 'getByCategoryRefCategoryId'], compact('categoryId'));
        return $this->formatResult($event, $eventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByCategoryRefCategoryIdList(int $categoryId, EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, string $q = null,  int $length = 12): EventServiceResponseList
    {
        $event = app()->call([$eventRepository, 'getByCategoryRefCategoryIdList'], compact('categoryId', 'length', 'q'));
        return $this->formatResultList($event, $eventServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByCityRefCityId(int $cityId, EventRepository $eventRepository, EventServiceResponse $eventServiceResponse): EventServiceResponse
    {
        $event = app()->call([$eventRepository, 'getByCityRefCityId'], compact('cityId'));
        return $this->formatResult($event, $eventServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByCityRefCityIdList(int $cityId, EventRepository $eventRepository, EventServiceResponseList $eventServiceResponseList, string $q = null,  int $length = 12): EventServiceResponseList
    {
        $event = app()->call([$eventRepository, 'getByCityRefCityIdList'], compact('cityId', 'length', 'q'));
        return $this->formatResultList($event, $eventServiceResponseList);
    }

}
