<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\Requests\OrderRepositoryRequest;
use App\Services\Requests\OrderServiceRequest;
use App\Services\Responses\OrderServiceResponse;
use App\Services\Responses\OrderServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:13
 * Time: 2022/09/14
 * Class OrderServiceTrait
 * @package App\Services
 */
trait OrderServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(OrderServiceRequest $orderServiceRequest, OrderRepositoryRequest $orderRepositoryRequest, OrderRepository $orderRepository, OrderServiceResponse $orderServiceResponse): OrderServiceResponse
    {
        $orderRepositoryRequest = Lazy::transform($orderServiceRequest, $orderRepositoryRequest);

        $result = app()->call([$orderRepository, 'store'], ['orderRepositoryRequest' => $orderRepositoryRequest]);
        if ($result != null) {
            $orderServiceResponse->status = true;
            $orderServiceResponse->message = 'Store Data Success';
            $orderServiceResponse->order = $result;
        } else {
            $orderServiceResponse->status = false;
            $orderServiceResponse->message = 'Store Data Failed';
        }

        return $orderServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $orderId, OrderServiceRequest $orderServiceRequest, OrderRepositoryRequest $orderRepositoryRequest, OrderRepository $orderRepository, OrderServiceResponse $orderServiceResponse): OrderServiceResponse
    {
        $orderRepositoryRequest = Lazy::transform($orderServiceRequest, $orderRepositoryRequest);

        $result = app()->call([$orderRepository, 'update'], ['orderId' => $orderId, 'orderRepositoryRequest' => $orderRepositoryRequest]);
        if ($result != null) {
            $orderServiceResponse->status = true;
            $orderServiceResponse->message = 'Update Data Success';
            $orderServiceResponse->order = $result;
        } else {
            $orderServiceResponse->status = false;
            $orderServiceResponse->message = 'Update Data Failed';
        }

        return $orderServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $orderId, OrderRepository $orderRepository, OrderServiceResponse $orderServiceResponse): OrderServiceResponse
    {
        $status = app()->call([$orderRepository, 'delete'], compact('orderId'));
        $orderServiceResponse->status = $status;
        if($status){
            $orderServiceResponse->message = "Delete Success";
        }else{
            $orderServiceResponse->message = "Delete Failed";
        }

        return $orderServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param OrderServiceResponseList $orderServiceResponseList
     * @return OrderServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, OrderServiceResponseList $orderServiceResponseList): OrderServiceResponseList{
        if (count($result) > 0) {
            $orderServiceResponseList->status = true;
            $orderServiceResponseList->message = 'Data Found';
            $orderServiceResponseList->orderList = $result;
            $orderServiceResponseList->count = $result->total();
            $orderServiceResponseList->countFiltered = $result->count();
        } else {
            $orderServiceResponseList->status = false;
            $orderServiceResponseList->message = 'Data Not Found';
        }
        return $orderServiceResponseList;
    }

    /**
     * @param Order|null $order
     * @param OrderServiceResponse $orderServiceResponse
     * @return OrderServiceResponse
     */
    private function formatResult(?Order $order, OrderServiceResponse $orderServiceResponse): OrderServiceResponse{
        if($order == null){
            $orderServiceResponse->status = false;
            $orderServiceResponse->message = "Data Not Found";
        }else{
            $orderServiceResponse->status = true;
            $orderServiceResponse->message = "Data Found";
            $orderServiceResponse->order = $order;
        }

        return $orderServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(OrderRepository $orderRepository, OrderServiceResponseList $orderServiceResponseList, int $length = 12, string $q = null): OrderServiceResponseList
    {
        $result = app()->call([$orderRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $orderServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(OrderRepository $orderRepository, string $q = null): int
    {
        return app()->call([$orderRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByOrderId(int $orderId, OrderRepository $orderRepository, OrderServiceResponse $orderServiceResponse): OrderServiceResponse
    {
        $order = app()->call([$orderRepository, 'getByOrderId'], compact('orderId'));
        return $this->formatResult($order, $orderServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderIdList(int $orderId, OrderRepository $orderRepository, OrderServiceResponseList $orderServiceResponseList, string $q = null,  int $length = 12): OrderServiceResponseList
    {
        $order = app()->call([$orderRepository, 'getByOrderIdList'], compact('orderId', 'length', 'q'));
        return $this->formatResultList($order, $orderServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberId(int $memberId, OrderRepository $orderRepository, OrderServiceResponse $orderServiceResponse): OrderServiceResponse
    {
        $order = app()->call([$orderRepository, 'getByMemberMemberId'], compact('memberId'));
        return $this->formatResult($order, $orderServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberIdList(int $memberId, OrderRepository $orderRepository, OrderServiceResponseList $orderServiceResponseList, string $q = null,  int $length = 12): OrderServiceResponseList
    {
        $order = app()->call([$orderRepository, 'getByMemberMemberIdList'], compact('memberId', 'length', 'q'));
        return $this->formatResultList($order, $orderServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusId(int $orderStatusId, OrderRepository $orderRepository, OrderServiceResponse $orderServiceResponse): OrderServiceResponse
    {
        $order = app()->call([$orderRepository, 'getByOrderStatusOrderStatusId'], compact('orderStatusId'));
        return $this->formatResult($order, $orderServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusIdList(int $orderStatusId, OrderRepository $orderRepository, OrderServiceResponseList $orderServiceResponseList, string $q = null,  int $length = 12): OrderServiceResponseList
    {
        $order = app()->call([$orderRepository, 'getByOrderStatusOrderStatusIdList'], compact('orderStatusId', 'length', 'q'));
        return $this->formatResultList($order, $orderServiceResponseList);
    }

}
