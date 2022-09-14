<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\EventGallery;
use App\Repositories\EventGalleryRepository;
use App\Repositories\Requests\EventGalleryRepositoryRequest;
use App\Services\Requests\EventGalleryServiceRequest;
use App\Services\Responses\EventGalleryServiceResponse;
use App\Services\Responses\EventGalleryServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:01
 * Time: 2022/09/14
 * Class EventGalleryServiceTrait
 * @package App\Services
 */
trait EventGalleryServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(EventGalleryServiceRequest $eventGalleryServiceRequest, EventGalleryRepositoryRequest $eventGalleryRepositoryRequest, EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponse $eventGalleryServiceResponse): EventGalleryServiceResponse
    {
        $eventGalleryRepositoryRequest = Lazy::transform($eventGalleryServiceRequest, $eventGalleryRepositoryRequest);

        $result = app()->call([$eventGalleryRepository, 'store'], ['eventGalleryRepositoryRequest' => $eventGalleryRepositoryRequest]);
        if ($result != null) {
            $eventGalleryServiceResponse->status = true;
            $eventGalleryServiceResponse->message = 'Store Data Success';
            $eventGalleryServiceResponse->eventGallery = $result;
        } else {
            $eventGalleryServiceResponse->status = false;
            $eventGalleryServiceResponse->message = 'Store Data Failed';
        }

        return $eventGalleryServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventGalleryId, EventGalleryServiceRequest $eventGalleryServiceRequest, EventGalleryRepositoryRequest $eventGalleryRepositoryRequest, EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponse $eventGalleryServiceResponse): EventGalleryServiceResponse
    {
        $eventGalleryRepositoryRequest = Lazy::transform($eventGalleryServiceRequest, $eventGalleryRepositoryRequest);

        $result = app()->call([$eventGalleryRepository, 'update'], ['eventGalleryId' => $eventGalleryId, 'eventGalleryRepositoryRequest' => $eventGalleryRepositoryRequest]);
        if ($result != null) {
            $eventGalleryServiceResponse->status = true;
            $eventGalleryServiceResponse->message = 'Update Data Success';
            $eventGalleryServiceResponse->eventGallery = $result;
        } else {
            $eventGalleryServiceResponse->status = false;
            $eventGalleryServiceResponse->message = 'Update Data Failed';
        }

        return $eventGalleryServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventGalleryId, EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponse $eventGalleryServiceResponse): EventGalleryServiceResponse
    {
        $status = app()->call([$eventGalleryRepository, 'delete'], compact('eventGalleryId'));
        $eventGalleryServiceResponse->status = $status;
        if($status){
            $eventGalleryServiceResponse->message = "Delete Success";
        }else{
            $eventGalleryServiceResponse->message = "Delete Failed";
        }

        return $eventGalleryServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param EventGalleryServiceResponseList $eventGalleryServiceResponseList
     * @return EventGalleryServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, EventGalleryServiceResponseList $eventGalleryServiceResponseList): EventGalleryServiceResponseList{
        if (count($result) > 0) {
            $eventGalleryServiceResponseList->status = true;
            $eventGalleryServiceResponseList->message = 'Data Found';
            $eventGalleryServiceResponseList->eventGalleryList = $result;
            $eventGalleryServiceResponseList->count = $result->total();
            $eventGalleryServiceResponseList->countFiltered = $result->count();
        } else {
            $eventGalleryServiceResponseList->status = false;
            $eventGalleryServiceResponseList->message = 'Data Not Found';
        }
        return $eventGalleryServiceResponseList;
    }

    /**
     * @param EventGallery|null $eventGallery
     * @param EventGalleryServiceResponse $eventGalleryServiceResponse
     * @return EventGalleryServiceResponse
     */
    private function formatResult(?EventGallery $eventGallery, EventGalleryServiceResponse $eventGalleryServiceResponse): EventGalleryServiceResponse{
        if($eventGallery == null){
            $eventGalleryServiceResponse->status = false;
            $eventGalleryServiceResponse->message = "Data Not Found";
        }else{
            $eventGalleryServiceResponse->status = true;
            $eventGalleryServiceResponse->message = "Data Found";
            $eventGalleryServiceResponse->eventGallery = $eventGallery;
        }

        return $eventGalleryServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponseList $eventGalleryServiceResponseList, int $length = 12, string $q = null): EventGalleryServiceResponseList
    {
        $result = app()->call([$eventGalleryRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $eventGalleryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(EventGalleryRepository $eventGalleryRepository, string $q = null): int
    {
        return app()->call([$eventGalleryRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByEventGalleryId(int $eventGalleryId, EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponse $eventGalleryServiceResponse): EventGalleryServiceResponse
    {
        $eventGallery = app()->call([$eventGalleryRepository, 'getByEventGalleryId'], compact('eventGalleryId'));
        return $this->formatResult($eventGallery, $eventGalleryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventGalleryIdList(int $eventGalleryId, EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponseList $eventGalleryServiceResponseList, string $q = null,  int $length = 12): EventGalleryServiceResponseList
    {
        $eventGallery = app()->call([$eventGalleryRepository, 'getByEventGalleryIdList'], compact('eventGalleryId', 'length', 'q'));
        return $this->formatResultList($eventGallery, $eventGalleryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponse $eventGalleryServiceResponse): EventGalleryServiceResponse
    {
        $eventGallery = app()->call([$eventGalleryRepository, 'getByEventEventId'], compact('eventId'));
        return $this->formatResult($eventGallery, $eventGalleryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponseList $eventGalleryServiceResponseList, string $q = null,  int $length = 12): EventGalleryServiceResponseList
    {
        $eventGallery = app()->call([$eventGalleryRepository, 'getByEventEventIdList'], compact('eventId', 'length', 'q'));
        return $this->formatResultList($eventGallery, $eventGalleryServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageId(int $imageId, EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponse $eventGalleryServiceResponse): EventGalleryServiceResponse
    {
        $eventGallery = app()->call([$eventGalleryRepository, 'getByImageImageId'], compact('imageId'));
        return $this->formatResult($eventGallery, $eventGalleryServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByImageImageIdList(int $imageId, EventGalleryRepository $eventGalleryRepository, EventGalleryServiceResponseList $eventGalleryServiceResponseList, string $q = null,  int $length = 12): EventGalleryServiceResponseList
    {
        $eventGallery = app()->call([$eventGalleryRepository, 'getByImageImageIdList'], compact('imageId', 'length', 'q'));
        return $this->formatResultList($eventGallery, $eventGalleryServiceResponseList);
    }

}
