<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Member;
use App\Models\Order;
use App\Repositories\Requests\OrderRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:13
 * Time: 2022/09/14
 * Trait OrderRepositoryTrait
 * @package App\Repositories
 */
trait OrderRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $member = app()->make(Join::class);
        $member->class = Member::class;
        $member->foreign = 'order.orderMemberId';
        $member->type = 'inner';
        $member->primary = 'member.memberId';
        $this->joinTable['member'] = $member;

        $order_status = app()->make(Join::class);
        $order_status->class = OrderStatus::class;
        $order_status->foreign = 'order.orderOrderStatus';
        $order_status->type = 'inner';
        $order_status->primary = 'order_status.orderStatusId';
        $this->joinTable['order_status'] = $order_status;

    }

    /**
     * @inheritDoc
     */
    public function store(OrderRepositoryRequest $orderRepositoryRequest, Order $order): ?Order
    {
        try {
            $order = Lazy::transform($orderRepositoryRequest, $order);
            $order->save();
            return $order;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $orderId, OrderRepositoryRequest $orderRepositoryRequest, Order $order): ?Order
    {
        $order = $order->where('orderId', $orderId)->first();
        if($order != null){
            try {
                $order = Lazy::transform($orderRepositoryRequest, $order);
                $order->save();
                return $order;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $order;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $orderId, Order $order): bool
    {
        $order = $order->where('order.orderId',$orderId)->first();
        if($order!=null){
            return $order->delete();
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
    public function get(Order $order, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($order)
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
    public function getCount(Order $order, string $q = null): int
    {
        return $this
            ->getJoin($order)
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
    public function getByOrderId(int $orderId, Order $order):? Order
    {
        return $this
            ->getJoin($order)
            ->where('order.orderId', '=', $orderId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderIdList(int $orderId, Order $order, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($order)
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
    public function getByMemberMemberId(int $memberId, Order $order):? Order
    {
        return $this
            ->getJoin($order)
            ->where('member.memberId', '=', $memberId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberIdList(int $memberId, Order $order, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($order)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('member.memberId', '=', $memberId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusId(int $orderStatusId, Order $order):? Order
    {
        return $this
            ->getJoin($order)
            ->where('order_status.orderStatusId', '=', $orderStatusId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusIdList(int $orderStatusId, Order $order, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($order)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('order_status.orderStatusId', '=', $orderStatusId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
