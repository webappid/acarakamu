<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\EventMemberLike;
use App\Repositories\EventMemberLikeRepository;
use App\Repositories\Requests\EventMemberLikeRepositoryRequest;
use App\Services\Requests\EventMemberLikeServiceRequest;
use App\Services\Responses\EventMemberLikeServiceResponse;
use App\Services\Responses\EventMemberLikeServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:03
 * Time: 2022/09/14
 * Class EventMemberLikeServiceTrait
 * @package App\Services
 */
trait EventMemberLikeServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(EventMemberLikeServiceRequest $eventMemberLikeServiceRequest, EventMemberLikeRepositoryRequest $eventMemberLikeRepositoryRequest, EventMemberLikeRepository $eventMemberLikeRepository, EventMemberLikeServiceResponse $eventMemberLikeServiceResponse): EventMemberLikeServiceResponse
    {
        $eventMemberLikeRepositoryRequest = Lazy::transform($eventMemberLikeServiceRequest, $eventMemberLikeRepositoryRequest);

        $result = app()->call([$eventMemberLikeRepository, 'store'], ['eventMemberLikeRepositoryRequest' => $eventMemberLikeRepositoryRequest]);
        if ($result != null) {
            $eventMemberLikeServiceResponse->status = true;
            $eventMemberLikeServiceResponse->message = 'Store Data Success';
            $eventMemberLikeServiceResponse->eventMemberLike = $result;
        } else {
            $eventMemberLikeServiceResponse->status = false;
            $eventMemberLikeServiceResponse->message = 'Store Data Failed';
        }

        return $eventMemberLikeServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventMemberLikeId, EventMemberLikeServiceRequest $eventMemberLikeServiceRequest, EventMemberLikeRepositoryRequest $eventMemberLikeRepositoryRequest, EventMemberLikeRepository $eventMemberLikeRepository, EventMemberLikeServiceResponse $eventMemberLikeServiceResponse): EventMemberLikeServiceResponse
    {
        $eventMemberLikeRepositoryRequest = Lazy::transform($eventMemberLikeServiceRequest, $eventMemberLikeRepositoryRequest);

        $result = app()->call([$eventMemberLikeRepository, 'update'], ['eventMemberLikeId' => $eventMemberLikeId, 'eventMemberLikeRepositoryRequest' => $eventMemberLikeRepositoryRequest]);
        if ($result != null) {
            $eventMemberLikeServiceResponse->status = true;
            $eventMemberLikeServiceResponse->message = 'Update Data Success';
            $eventMemberLikeServiceResponse->eventMemberLike = $result;
        } else {
            $eventMemberLikeServiceResponse->status = false;
            $eventMemberLikeServiceResponse->message = 'Update Data Failed';
        }

        return $eventMemberLikeServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventMemberLikeId, EventMemberLikeRepository $eventMemberLikeRepository, EventMemberLikeServiceResponse $eventMemberLikeServiceResponse): EventMemberLikeServiceResponse
    {
        $status = app()->call([$eventMemberLikeRepository, 'delete'], compact('eventMemberLikeId'));
        $eventMemberLikeServiceResponse->status = $status;
        if($status){
            $eventMemberLikeServiceResponse->message = "Delete Success";
        }else{
            $eventMemberLikeServiceResponse->message = "Delete Failed";
        }

        return $eventMemberLikeServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param EventMemberLikeServiceResponseList $eventMemberLikeServiceResponseList
     * @return EventMemberLikeServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, EventMemberLikeServiceResponseList $eventMemberLikeServiceResponseList): EventMemberLikeServiceResponseList{
        if (count($result) > 0) {
            $eventMemberLikeServiceResponseList->status = true;
            $eventMemberLikeServiceResponseList->message = 'Data Found';
            $eventMemberLikeServiceResponseList->eventMemberLikeList = $result;
            $eventMemberLikeServiceResponseList->count = $result->total();
            $eventMemberLikeServiceResponseList->countFiltered = $result->count();
        } else {
            $eventMemberLikeServiceResponseList->status = false;
            $eventMemberLikeServiceResponseList->message = 'Data Not Found';
        }
        return $eventMemberLikeServiceResponseList;
    }

    /**
     * @param EventMemberLike|null $eventMemberLike
     * @param EventMemberLikeServiceResponse $eventMemberLikeServiceResponse
     * @return EventMemberLikeServiceResponse
     */
    private function formatResult(?EventMemberLike $eventMemberLike, EventMemberLikeServiceResponse $eventMemberLikeServiceResponse): EventMemberLikeServiceResponse{
        if($eventMemberLike == null){
            $eventMemberLikeServiceResponse->status = false;
            $eventMemberLikeServiceResponse->message = "Data Not Found";
        }else{
            $eventMemberLikeServiceResponse->status = true;
            $eventMemberLikeServiceResponse->message = "Data Found";
            $eventMemberLikeServiceResponse->eventMemberLike = $eventMemberLike;
        }

        return $eventMemberLikeServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(EventMemberLikeRepository $eventMemberLikeRepository, EventMemberLikeServiceResponseList $eventMemberLikeServiceResponseList, int $length = 12, string $q = null): EventMemberLikeServiceResponseList
    {
        $result = app()->call([$eventMemberLikeRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $eventMemberLikeServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(EventMemberLikeRepository $eventMemberLikeRepository, string $q = null): int
    {
        return app()->call([$eventMemberLikeRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByEventMemberLikeId(int $eventMemberLikeId, EventMemberLikeRepository $eventMemberLikeRepository, EventMemberLikeServiceResponse $eventMemberLikeServiceResponse): EventMemberLikeServiceResponse
    {
        $eventMemberLike = app()->call([$eventMemberLikeRepository, 'getByEventMemberLikeId'], compact('eventMemberLikeId'));
        return $this->formatResult($eventMemberLike, $eventMemberLikeServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventMemberLikeIdList(int $eventMemberLikeId, EventMemberLikeRepository $eventMemberLikeRepository, EventMemberLikeServiceResponseList $eventMemberLikeServiceResponseList, string $q = null,  int $length = 12): EventMemberLikeServiceResponseList
    {
        $eventMemberLike = app()->call([$eventMemberLikeRepository, 'getByEventMemberLikeIdList'], compact('eventMemberLikeId', 'length', 'q'));
        return $this->formatResultList($eventMemberLike, $eventMemberLikeServiceResponseList);
    }

}
