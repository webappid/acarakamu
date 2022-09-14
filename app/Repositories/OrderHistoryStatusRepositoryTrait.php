<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderHistoryStatus;
use App\Repositories\Requests\OrderHistoryStatusRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:15
 * Time: 2022/09/14
 * Trait OrderHistoryStatusRepositoryTrait
 * @package App\Repositories
 */
trait OrderHistoryStatusRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $order = app()->make(Join::class);
        $order->class = Order::class;
        $order->foreign = 'order_history_status.orderHistoryStatusOrderId';
        $order->type = 'inner';
        $order->primary = 'order.orderId';
        $this->joinTable['order'] = $order;

        $order_status = app()->make(Join::class);
        $order_status->class = OrderStatus::class;
        $order_status->foreign = 'order_history_status.orderHistoryStatusStatusId';
        $order_status->type = 'inner';
        $order_status->primary = 'order_status.orderStatusId';
        $this->joinTable['order_status'] = $order_status;

        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'order_history_status.orderHistoryStatusUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(OrderHistoryStatusRepositoryRequest $orderHistoryStatusRepositoryRequest, OrderHistoryStatus $orderHistoryStatus): ?OrderHistoryStatus
    {
        try {
            $orderHistoryStatus = Lazy::transform($orderHistoryStatusRepositoryRequest, $orderHistoryStatus);
            $orderHistoryStatus->save();
            return $orderHistoryStatus;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $orderHistoryStatusId, OrderHistoryStatusRepositoryRequest $orderHistoryStatusRepositoryRequest, OrderHistoryStatus $orderHistoryStatus): ?OrderHistoryStatus
    {
        $orderHistoryStatus = $orderHistoryStatus->where('orderHistoryStatusId', $orderHistoryStatusId)->first();
        if($orderHistoryStatus != null){
            try {
                $orderHistoryStatus = Lazy::transform($orderHistoryStatusRepositoryRequest, $orderHistoryStatus);
                $orderHistoryStatus->save();
                return $orderHistoryStatus;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $orderHistoryStatus;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $orderHistoryStatusId, OrderHistoryStatus $orderHistoryStatus): bool
    {
        $orderHistoryStatus = $orderHistoryStatus->where('order_history_status.orderHistoryStatusId',$orderHistoryStatusId)->first();
        if($orderHistoryStatus!=null){
            return $orderHistoryStatus->delete();
        }else{
            return false;
        }
    }

    /**
     * @param Builder $query
     * @param string $q
     * @return Builder
     */
    protected Function getFilter(Builder $query, string $q)
    {
        return $query->where(function($query) use ($q){
            return $query;
        });

    }

    /**
     * @inheritDoc
     */
    public function get(OrderHistoryStatus $orderHistoryStatus, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->paginate($length, $this->getColumn())
            ->appends(request()->all());
    }

    /**
     * @inheritDoc
     */
    public function getCount(OrderHistoryStatus $orderHistoryStatus, string $q = null): int
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->count();
    }

        /**
     * @inheritDoc
     */
    public function getByOrderHistoryStatusId(int $orderHistoryStatusId, OrderHistoryStatus $orderHistoryStatus):? OrderHistoryStatus
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->where('order_history_status.orderHistoryStatusId', '=', $orderHistoryStatusId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderHistoryStatusIdList(int $orderHistoryStatusId, OrderHistoryStatus $orderHistoryStatus, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('order_history_status.orderHistoryStatusId', '=', $orderHistoryStatusId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderOrderId(int $orderId, OrderHistoryStatus $orderHistoryStatus):? OrderHistoryStatus
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->where('order.orderId', '=', $orderId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderOrderIdList(int $orderId, OrderHistoryStatus $orderHistoryStatus, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('order.orderId', '=', $orderId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusId(int $orderStatusId, OrderHistoryStatus $orderHistoryStatus):? OrderHistoryStatus
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->where('order_status.orderStatusId', '=', $orderStatusId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusIdList(int $orderStatusId, OrderHistoryStatus $orderHistoryStatus, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('order_status.orderStatusId', '=', $orderStatusId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, OrderHistoryStatus $orderHistoryStatus):? OrderHistoryStatus
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, OrderHistoryStatus $orderHistoryStatus, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user.userName', '=', $userName )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserId(int $userId, OrderHistoryStatus $orderHistoryStatus):? OrderHistoryStatus
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, OrderHistoryStatus $orderHistoryStatus, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderHistoryStatus)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user.userId', '=', $userId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
