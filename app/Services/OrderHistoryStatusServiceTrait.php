<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Services;

use App\Models\OrderHistoryStatus;
use App\Repositories\OrderHistoryStatusRepository;
use App\Repositories\Requests\OrderHistoryStatusRepositoryRequest;
use App\Services\Requests\OrderHistoryStatusServiceRequest;
use App\Services\Responses\OrderHistoryStatusServiceResponse;
use App\Services\Responses\OrderHistoryStatusServiceResponseList;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Tools\Lazy;

/**
 * @author: 
 * Date: 16:04:15
 * Time: 2022/09/14
 * Class OrderHistoryStatusServiceTrait
 * @package App\Services
 */
trait OrderHistoryStatusServiceTrait
{

    /**
     * @inheritDoc
     */
    public function store(OrderHistoryStatusServiceRequest $orderHistoryStatusServiceRequest, OrderHistoryStatusRepositoryRequest $orderHistoryStatusRepositoryRequest, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse): OrderHistoryStatusServiceResponse
    {
        $orderHistoryStatusRepositoryRequest = Lazy::transform($orderHistoryStatusServiceRequest, $orderHistoryStatusRepositoryRequest);

        $result = app()->call([$orderHistoryStatusRepository, 'store'], ['orderHistoryStatusRepositoryRequest' => $orderHistoryStatusRepositoryRequest]);
        if ($result != null) {
            $orderHistoryStatusServiceResponse->status = true;
            $orderHistoryStatusServiceResponse->message = 'Store Data Success';
            $orderHistoryStatusServiceResponse->orderHistoryStatus = $result;
        } else {
            $orderHistoryStatusServiceResponse->status = false;
            $orderHistoryStatusServiceResponse->message = 'Store Data Failed';
        }

        return $orderHistoryStatusServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $orderHistoryStatusId, OrderHistoryStatusServiceRequest $orderHistoryStatusServiceRequest, OrderHistoryStatusRepositoryRequest $orderHistoryStatusRepositoryRequest, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse): OrderHistoryStatusServiceResponse
    {
        $orderHistoryStatusRepositoryRequest = Lazy::transform($orderHistoryStatusServiceRequest, $orderHistoryStatusRepositoryRequest);

        $result = app()->call([$orderHistoryStatusRepository, 'update'], ['orderHistoryStatusId' => $orderHistoryStatusId, 'orderHistoryStatusRepositoryRequest' => $orderHistoryStatusRepositoryRequest]);
        if ($result != null) {
            $orderHistoryStatusServiceResponse->status = true;
            $orderHistoryStatusServiceResponse->message = 'Update Data Success';
            $orderHistoryStatusServiceResponse->orderHistoryStatus = $result;
        } else {
            $orderHistoryStatusServiceResponse->status = false;
            $orderHistoryStatusServiceResponse->message = 'Update Data Failed';
        }

        return $orderHistoryStatusServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $orderHistoryStatusId, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse): OrderHistoryStatusServiceResponse
    {
        $status = app()->call([$orderHistoryStatusRepository, 'delete'], compact('orderHistoryStatusId'));
        $orderHistoryStatusServiceResponse->status = $status;
        if($status){
            $orderHistoryStatusServiceResponse->message = "Delete Success";
        }else{
            $orderHistoryStatusServiceResponse->message = "Delete Failed";
        }

        return $orderHistoryStatusServiceResponse;
    }

    /**
     * @param LengthAwarePaginator $result
     * @param OrderHistoryStatusServiceResponseList $orderHistoryStatusServiceResponseList
     * @return OrderHistoryStatusServiceResponseList
     */
    private function formatResultList(LengthAwarePaginator $result, OrderHistoryStatusServiceResponseList $orderHistoryStatusServiceResponseList): OrderHistoryStatusServiceResponseList{
        if (count($result) > 0) {
            $orderHistoryStatusServiceResponseList->status = true;
            $orderHistoryStatusServiceResponseList->message = 'Data Found';
            $orderHistoryStatusServiceResponseList->orderHistoryStatusList = $result;
            $orderHistoryStatusServiceResponseList->count = $result->total();
            $orderHistoryStatusServiceResponseList->countFiltered = $result->count();
        } else {
            $orderHistoryStatusServiceResponseList->status = false;
            $orderHistoryStatusServiceResponseList->message = 'Data Not Found';
        }
        return $orderHistoryStatusServiceResponseList;
    }

    /**
     * @param OrderHistoryStatus|null $orderHistoryStatus
     * @param OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse
     * @return OrderHistoryStatusServiceResponse
     */
    private function formatResult(?OrderHistoryStatus $orderHistoryStatus, OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse): OrderHistoryStatusServiceResponse{
        if($orderHistoryStatus == null){
            $orderHistoryStatusServiceResponse->status = false;
            $orderHistoryStatusServiceResponse->message = "Data Not Found";
        }else{
            $orderHistoryStatusServiceResponse->status = true;
            $orderHistoryStatusServiceResponse->message = "Data Found";
            $orderHistoryStatusServiceResponse->orderHistoryStatus = $orderHistoryStatus;
        }

        return $orderHistoryStatusServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function get(OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponseList $orderHistoryStatusServiceResponseList, int $length = 12, string $q = null): OrderHistoryStatusServiceResponseList
    {
        $result = app()->call([$orderHistoryStatusRepository, 'get'], compact('q', 'length'));

        return $this->formatResultList($result, $orderHistoryStatusServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getCount(OrderHistoryStatusRepository $orderHistoryStatusRepository, string $q = null): int
    {
        return app()->call([$orderHistoryStatusRepository, 'getCount'], compact('q'));
    }
    /**
     * @inheritDoc
     */
    public function getByOrderHistoryStatusId(int $orderHistoryStatusId, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse): OrderHistoryStatusServiceResponse
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getByOrderHistoryStatusId'], compact('orderHistoryStatusId'));
        return $this->formatResult($orderHistoryStatus, $orderHistoryStatusServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderHistoryStatusIdList(int $orderHistoryStatusId, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponseList $orderHistoryStatusServiceResponseList, string $q = null,  int $length = 12): OrderHistoryStatusServiceResponseList
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getByOrderHistoryStatusIdList'], compact('orderHistoryStatusId', 'length', 'q'));
        return $this->formatResultList($orderHistoryStatus, $orderHistoryStatusServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderOrderId(int $orderId, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse): OrderHistoryStatusServiceResponse
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getByOrderOrderId'], compact('orderId'));
        return $this->formatResult($orderHistoryStatus, $orderHistoryStatusServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderOrderIdList(int $orderId, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponseList $orderHistoryStatusServiceResponseList, string $q = null,  int $length = 12): OrderHistoryStatusServiceResponseList
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getByOrderOrderIdList'], compact('orderId', 'length', 'q'));
        return $this->formatResultList($orderHistoryStatus, $orderHistoryStatusServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusId(int $orderStatusId, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse): OrderHistoryStatusServiceResponse
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getByOrderStatusOrderStatusId'], compact('orderStatusId'));
        return $this->formatResult($orderHistoryStatus, $orderHistoryStatusServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusIdList(int $orderStatusId, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponseList $orderHistoryStatusServiceResponseList, string $q = null,  int $length = 12): OrderHistoryStatusServiceResponseList
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getByOrderStatusOrderStatusIdList'], compact('orderStatusId', 'length', 'q'));
        return $this->formatResultList($orderHistoryStatus, $orderHistoryStatusServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse): OrderHistoryStatusServiceResponse
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getBySfUserUserName'], compact('userName'));
        return $this->formatResult($orderHistoryStatus, $orderHistoryStatusServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponseList $orderHistoryStatusServiceResponseList, string $q = null,  int $length = 12): OrderHistoryStatusServiceResponseList
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getBySfUserUserNameList'], compact('userName', 'length', 'q'));
        return $this->formatResultList($orderHistoryStatus, $orderHistoryStatusServiceResponseList);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponse $orderHistoryStatusServiceResponse): OrderHistoryStatusServiceResponse
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getBySfUserUserId'], compact('userId'));
        return $this->formatResult($orderHistoryStatus, $orderHistoryStatusServiceResponse);
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, OrderHistoryStatusRepository $orderHistoryStatusRepository, OrderHistoryStatusServiceResponseList $orderHistoryStatusServiceResponseList, string $q = null,  int $length = 12): OrderHistoryStatusServiceResponseList
    {
        $orderHistoryStatus = app()->call([$orderHistoryStatusRepository, 'getBySfUserUserIdList'], compact('userId', 'length', 'q'));
        return $this->formatResultList($orderHistoryStatus, $orderHistoryStatusServiceResponseList);
    }

}
