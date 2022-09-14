<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\OrderStatus;
use App\Repositories\OrderStatusRepository;
use App\Repositories\Requests\OrderStatusRepositoryRequest;
use App\Services\Requests\OrderStatusServiceRequest;
use App\Services\Responses\OrderStatusServiceResponse;
use App\Services\Responses\OrderStatusServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:16
 * Time: 2022/09/14
 * Class OrderStatusServiceTrait
 * @package App\Services
 */
trait OrderStatusServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(OrderStatusServiceRequest $orderStatusServiceRequest, OrderStatusRepositoryRequest $orderStatusRepositoryRequest, OrderStatusRepository $orderStatusRepository, OrderStatusServiceResponse $orderStatusServiceResponse): OrderStatusServiceResponse
    {
        $orderStatusRepositoryRequest = Lazy::transform($orderStatusServiceRequest, $orderStatusRepositoryRequest);

        $result = app()->call([$orderStatusRepository, 'store'], ['orderStatusRepositoryRequest' => $orderStatusRepositoryRequest]);
        if ($result != null) {
            $orderStatusServiceResponse->status = true;
            $orderStatusServiceResponse->message = 'Store Data Success';
            $orderStatusServiceResponse->orderStatus = $result;
        } else {
            $orderStatusServiceResponse->status = false;
            $orderStatusServiceResponse->message = 'Store Data Failed';
        }

        return $orderStatusServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $orderStatusId, OrderStatusServiceRequest $orderStatusServiceRequest, OrderStatusRepositoryRequest $orderStatusRepositoryRequest, OrderStatusRepository $orderStatusRepository, OrderStatusServiceResponse $orderStatusServiceResponse): OrderStatusServiceResponse
    {
        $orderStatusRepositoryRequest = Lazy::transform($orderStatusServiceRequest, $orderStatusRepositoryRequest);

        $result = app()->call([$orderStatusRepository, 'update'], ['orderStatusId' => $orderStatusId, 'orderStatusRepositoryRequest' => $orderStatusRepositoryRequest]);
        if ($result != null) {
            $orderStatusServiceResponse->status = true;
            $orderStatusServiceResponse->message = 'Update Data Success';
            $orderStatusServiceResponse->orderStatus = $result;
        } else {
            $orderStatusServiceResponse->status = false;
            $orderStatusServiceResponse->message = 'Update Data Failed';
        }

        return $orderStatusServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $orderStatusId, OrderStatusRepository $orderStatusRepository, OrderStatusServiceResponse $orderStatusServiceResponse): OrderStatusServiceResponse
    {
        $status = app()->call([$orderStatusRepository, 'delete'], compact('orderStatusId'));
        $orderStatusServiceResponse->status = $status;
        if($status){
            $orderStatusServiceResponse->message = "Delete Success";
        }else{
            $orderStatusServiceResponse->message = "Delete Failed";
        }

        return $orderStatusServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param OrderStatusServiceResponseList $orderStatusServiceResponseList
     * @return OrderStatusServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, OrderStatusServiceResponseList $orderStatusServiceResponseList): OrderStatusServiceResponseList{
        if (count($result) > 0) {
            $orderStatusServiceResponseList->status = true;
            $orderStatusServiceResponseList->message = 'Data Found';
            $orderStatusServiceResponseList->orderStatusList = $result;
            $orderStatusServiceResponseList->count = $result->total();
            $orderStatusServiceResponseList->countFiltered = $result->count();
        } else {
            $orderStatusServiceResponseList->status = false;
            $orderStatusServiceResponseList->message = 'Data Not Found';
        }
        return $orderStatusServiceResponseList;
    }

    /**
     * @param OrderStatus|null $orderStatus
     * @param OrderStatusServiceResponse $orderStatusServiceResponse
     * @return OrderStatusServiceResponse
     */
    private function formatResult(?OrderStatus $orderStatus, OrderStatusServiceResponse $orderStatusServiceResponse): OrderStatusServiceResponse{
        if($orderStatus == null){
            $orderStatusServiceResponse->status = false;
            $orderStatusServiceResponse->message = "Data Not Found";
        }else{
            $orderStatusServiceResponse->status = true;
            $orderStatusServiceResponse->message = "Data Found";
            $orderStatusServiceResponse->orderStatus = $orderStatus;
        }

        return $orderStatusServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(OrderStatusRepository $orderStatusRepository, OrderStatusServiceResponseList $orderStatusServiceResponseList, int $length = 12, string $q = null): OrderStatusServiceResponseList
    {
        $result = app()->call([$orderStatusRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $orderStatusServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(OrderStatusRepository $orderStatusRepository, string $q = null): int
    {
        return app()->call([$orderStatusRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByOrderStatusId(int $orderStatusId, OrderStatusRepository $orderStatusRepository, OrderStatusServiceResponse $orderStatusServiceResponse): OrderStatusServiceResponse
    {
        $orderStatus = app()->call([$orderStatusRepository, 'getByOrderStatusId'], compact('orderStatusId'));
        return $this->formatResult($orderStatus, $orderStatusServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusIdList(int $orderStatusId, OrderStatusRepository $orderStatusRepository, OrderStatusServiceResponseList $orderStatusServiceResponseList, string $q = null,  int $length = 12): OrderStatusServiceResponseList
    {
        $orderStatus = app()->call([$orderStatusRepository, 'getByOrderStatusIdList'], compact('orderStatusId', 'length', 'q'));
        return $this->formatResultList($orderStatus, $orderStatusServiceResponseList);
    }

}
