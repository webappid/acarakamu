<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\EventWish;
use App\Repositories\EventWishRepository;
use App\Repositories\Requests\EventWishRepositoryRequest;
use App\Services\Requests\EventWishServiceRequest;
use App\Services\Responses\EventWishServiceResponse;
use App\Services\Responses\EventWishServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:06
 * Time: 2022/09/14
 * Class EventWishServiceTrait
 * @package App\Services
 */
trait EventWishServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(EventWishServiceRequest $eventWishServiceRequest, EventWishRepositoryRequest $eventWishRepositoryRequest, EventWishRepository $eventWishRepository, EventWishServiceResponse $eventWishServiceResponse): EventWishServiceResponse
    {
        $eventWishRepositoryRequest = Lazy::transform($eventWishServiceRequest, $eventWishRepositoryRequest);

        $result = app()->call([$eventWishRepository, 'store'], ['eventWishRepositoryRequest' => $eventWishRepositoryRequest]);
        if ($result != null) {
            $eventWishServiceResponse->status = true;
            $eventWishServiceResponse->message = 'Store Data Success';
            $eventWishServiceResponse->eventWish = $result;
        } else {
            $eventWishServiceResponse->status = false;
            $eventWishServiceResponse->message = 'Store Data Failed';
        }

        return $eventWishServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $wishListId, EventWishServiceRequest $eventWishServiceRequest, EventWishRepositoryRequest $eventWishRepositoryRequest, EventWishRepository $eventWishRepository, EventWishServiceResponse $eventWishServiceResponse): EventWishServiceResponse
    {
        $eventWishRepositoryRequest = Lazy::transform($eventWishServiceRequest, $eventWishRepositoryRequest);

        $result = app()->call([$eventWishRepository, 'update'], ['wishListId' => $wishListId, 'eventWishRepositoryRequest' => $eventWishRepositoryRequest]);
        if ($result != null) {
            $eventWishServiceResponse->status = true;
            $eventWishServiceResponse->message = 'Update Data Success';
            $eventWishServiceResponse->eventWish = $result;
        } else {
            $eventWishServiceResponse->status = false;
            $eventWishServiceResponse->message = 'Update Data Failed';
        }

        return $eventWishServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $wishListId, EventWishRepository $eventWishRepository, EventWishServiceResponse $eventWishServiceResponse): EventWishServiceResponse
    {
        $status = app()->call([$eventWishRepository, 'delete'], compact('wishListId'));
        $eventWishServiceResponse->status = $status;
        if($status){
            $eventWishServiceResponse->message = "Delete Success";
        }else{
            $eventWishServiceResponse->message = "Delete Failed";
        }

        return $eventWishServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param EventWishServiceResponseList $eventWishServiceResponseList
     * @return EventWishServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, EventWishServiceResponseList $eventWishServiceResponseList): EventWishServiceResponseList{
        if (count($result) > 0) {
            $eventWishServiceResponseList->status = true;
            $eventWishServiceResponseList->message = 'Data Found';
            $eventWishServiceResponseList->eventWishList = $result;
            $eventWishServiceResponseList->count = $result->total();
            $eventWishServiceResponseList->countFiltered = $result->count();
        } else {
            $eventWishServiceResponseList->status = false;
            $eventWishServiceResponseList->message = 'Data Not Found';
        }
        return $eventWishServiceResponseList;
    }

    /**
     * @param EventWish|null $eventWish
     * @param EventWishServiceResponse $eventWishServiceResponse
     * @return EventWishServiceResponse
     */
    private function formatResult(?EventWish $eventWish, EventWishServiceResponse $eventWishServiceResponse): EventWishServiceResponse{
        if($eventWish == null){
            $eventWishServiceResponse->status = false;
            $eventWishServiceResponse->message = "Data Not Found";
        }else{
            $eventWishServiceResponse->status = true;
            $eventWishServiceResponse->message = "Data Found";
            $eventWishServiceResponse->eventWish = $eventWish;
        }

        return $eventWishServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(EventWishRepository $eventWishRepository, EventWishServiceResponseList $eventWishServiceResponseList, int $length = 12, string $q = null): EventWishServiceResponseList
    {
        $result = app()->call([$eventWishRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $eventWishServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(EventWishRepository $eventWishRepository, string $q = null): int
    {
        return app()->call([$eventWishRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByWishListEventIdWishListEventMemberId(int $wishListEventId, int $wishListEventMemberId, EventWishRepository $eventWishRepository, EventWishServiceResponse $eventWishServiceResponse): EventWishServiceResponse
    {
        $eventWish = app()->call([$eventWishRepository, 'getByWishListEventIdWishListEventMemberId'], compact('wishListEventId', 'wishListEventMemberId'));
        return $this->formatResult($eventWish, $eventWishServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByWishListEventIdWishListEventMemberIdList(int $wishListEventId, int $wishListEventMemberId, EventWishRepository $eventWishRepository, EventWishServiceResponseList $eventWishServiceResponseList, string $q = null,  int $length = 12): EventWishServiceResponseList
    {
        $eventWish = app()->call([$eventWishRepository, 'getByWishListEventIdWishListEventMemberIdList'], compact('wishListEventId', 'wishListEventMemberId', 'length', 'q'));
        return $this->formatResultList($eventWish, $eventWishServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByWishListId(int $wishListId, EventWishRepository $eventWishRepository, EventWishServiceResponse $eventWishServiceResponse): EventWishServiceResponse
    {
        $eventWish = app()->call([$eventWishRepository, 'getByWishListId'], compact('wishListId'));
        return $this->formatResult($eventWish, $eventWishServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByWishListIdList(int $wishListId, EventWishRepository $eventWishRepository, EventWishServiceResponseList $eventWishServiceResponseList, string $q = null,  int $length = 12): EventWishServiceResponseList
    {
        $eventWish = app()->call([$eventWishRepository, 'getByWishListIdList'], compact('wishListId', 'length', 'q'));
        return $this->formatResultList($eventWish, $eventWishServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, EventWishRepository $eventWishRepository, EventWishServiceResponse $eventWishServiceResponse): EventWishServiceResponse
    {
        $eventWish = app()->call([$eventWishRepository, 'getByEventEventId'], compact('eventId'));
        return $this->formatResult($eventWish, $eventWishServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, EventWishRepository $eventWishRepository, EventWishServiceResponseList $eventWishServiceResponseList, string $q = null,  int $length = 12): EventWishServiceResponseList
    {
        $eventWish = app()->call([$eventWishRepository, 'getByEventEventIdList'], compact('eventId', 'length', 'q'));
        return $this->formatResultList($eventWish, $eventWishServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberId(int $memberId, EventWishRepository $eventWishRepository, EventWishServiceResponse $eventWishServiceResponse): EventWishServiceResponse
    {
        $eventWish = app()->call([$eventWishRepository, 'getByMemberMemberId'], compact('memberId'));
        return $this->formatResult($eventWish, $eventWishServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberIdList(int $memberId, EventWishRepository $eventWishRepository, EventWishServiceResponseList $eventWishServiceResponseList, string $q = null,  int $length = 12): EventWishServiceResponseList
    {
        $eventWish = app()->call([$eventWishRepository, 'getByMemberMemberIdList'], compact('memberId', 'length', 'q'));
        return $this->formatResultList($eventWish, $eventWishServiceResponseList);
    }

}
