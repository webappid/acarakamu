<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\OrderDetail;
use App\Repositories\OrderDetailRepository;
use App\Repositories\Requests\OrderDetailRepositoryRequest;
use App\Services\Requests\OrderDetailServiceRequest;
use App\Services\Responses\OrderDetailServiceResponse;
use App\Services\Responses\OrderDetailServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:14
 * Time: 2022/09/14
 * Class OrderDetailServiceTrait
 * @package App\Services
 */
trait OrderDetailServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(OrderDetailServiceRequest $orderDetailServiceRequest, OrderDetailRepositoryRequest $orderDetailRepositoryRequest, OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponse $orderDetailServiceResponse): OrderDetailServiceResponse
    {
        $orderDetailRepositoryRequest = Lazy::transform($orderDetailServiceRequest, $orderDetailRepositoryRequest);

        $result = app()->call([$orderDetailRepository, 'store'], ['orderDetailRepositoryRequest' => $orderDetailRepositoryRequest]);
        if ($result != null) {
            $orderDetailServiceResponse->status = true;
            $orderDetailServiceResponse->message = 'Store Data Success';
            $orderDetailServiceResponse->orderDetail = $result;
        } else {
            $orderDetailServiceResponse->status = false;
            $orderDetailServiceResponse->message = 'Store Data Failed';
        }

        return $orderDetailServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $orderDetailId, OrderDetailServiceRequest $orderDetailServiceRequest, OrderDetailRepositoryRequest $orderDetailRepositoryRequest, OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponse $orderDetailServiceResponse): OrderDetailServiceResponse
    {
        $orderDetailRepositoryRequest = Lazy::transform($orderDetailServiceRequest, $orderDetailRepositoryRequest);

        $result = app()->call([$orderDetailRepository, 'update'], ['orderDetailId' => $orderDetailId, 'orderDetailRepositoryRequest' => $orderDetailRepositoryRequest]);
        if ($result != null) {
            $orderDetailServiceResponse->status = true;
            $orderDetailServiceResponse->message = 'Update Data Success';
            $orderDetailServiceResponse->orderDetail = $result;
        } else {
            $orderDetailServiceResponse->status = false;
            $orderDetailServiceResponse->message = 'Update Data Failed';
        }

        return $orderDetailServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $orderDetailId, OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponse $orderDetailServiceResponse): OrderDetailServiceResponse
    {
        $status = app()->call([$orderDetailRepository, 'delete'], compact('orderDetailId'));
        $orderDetailServiceResponse->status = $status;
        if($status){
            $orderDetailServiceResponse->message = "Delete Success";
        }else{
            $orderDetailServiceResponse->message = "Delete Failed";
        }

        return $orderDetailServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param OrderDetailServiceResponseList $orderDetailServiceResponseList
     * @return OrderDetailServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, OrderDetailServiceResponseList $orderDetailServiceResponseList): OrderDetailServiceResponseList{
        if (count($result) > 0) {
            $orderDetailServiceResponseList->status = true;
            $orderDetailServiceResponseList->message = 'Data Found';
            $orderDetailServiceResponseList->orderDetailList = $result;
            $orderDetailServiceResponseList->count = $result->total();
            $orderDetailServiceResponseList->countFiltered = $result->count();
        } else {
            $orderDetailServiceResponseList->status = false;
            $orderDetailServiceResponseList->message = 'Data Not Found';
        }
        return $orderDetailServiceResponseList;
    }

    /**
     * @param OrderDetail|null $orderDetail
     * @param OrderDetailServiceResponse $orderDetailServiceResponse
     * @return OrderDetailServiceResponse
     */
    private function formatResult(?OrderDetail $orderDetail, OrderDetailServiceResponse $orderDetailServiceResponse): OrderDetailServiceResponse{
        if($orderDetail == null){
            $orderDetailServiceResponse->status = false;
            $orderDetailServiceResponse->message = "Data Not Found";
        }else{
            $orderDetailServiceResponse->status = true;
            $orderDetailServiceResponse->message = "Data Found";
            $orderDetailServiceResponse->orderDetail = $orderDetail;
        }

        return $orderDetailServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponseList $orderDetailServiceResponseList, int $length = 12, string $q = null): OrderDetailServiceResponseList
    {
        $result = app()->call([$orderDetailRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $orderDetailServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(OrderDetailRepository $orderDetailRepository, string $q = null): int
    {
        return app()->call([$orderDetailRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByOrderDetailId(int $orderDetailId, OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponse $orderDetailServiceResponse): OrderDetailServiceResponse
    {
        $orderDetail = app()->call([$orderDetailRepository, 'getByOrderDetailId'], compact('orderDetailId'));
        return $this->formatResult($orderDetail, $orderDetailServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderDetailIdList(int $orderDetailId, OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponseList $orderDetailServiceResponseList, string $q = null,  int $length = 12): OrderDetailServiceResponseList
    {
        $orderDetail = app()->call([$orderDetailRepository, 'getByOrderDetailIdList'], compact('orderDetailId', 'length', 'q'));
        return $this->formatResultList($orderDetail, $orderDetailServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderOrderId(int $orderId, OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponse $orderDetailServiceResponse): OrderDetailServiceResponse
    {
        $orderDetail = app()->call([$orderDetailRepository, 'getByOrderOrderId'], compact('orderId'));
        return $this->formatResult($orderDetail, $orderDetailServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderOrderIdList(int $orderId, OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponseList $orderDetailServiceResponseList, string $q = null,  int $length = 12): OrderDetailServiceResponseList
    {
        $orderDetail = app()->call([$orderDetailRepository, 'getByOrderOrderIdList'], compact('orderId', 'length', 'q'));
        return $this->formatResultList($orderDetail, $orderDetailServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponse $orderDetailServiceResponse): OrderDetailServiceResponse
    {
        $orderDetail = app()->call([$orderDetailRepository, 'getByEventEventId'], compact('eventId'));
        return $this->formatResult($orderDetail, $orderDetailServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, OrderDetailRepository $orderDetailRepository, OrderDetailServiceResponseList $orderDetailServiceResponseList, string $q = null,  int $length = 12): OrderDetailServiceResponseList
    {
        $orderDetail = app()->call([$orderDetailRepository, 'getByEventEventIdList'], compact('eventId', 'length', 'q'));
        return $this->formatResultList($orderDetail, $orderDetailServiceResponseList);
    }

}
