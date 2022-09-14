<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Event;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Requests\OrderDetailRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:14
 * Time: 2022/09/14
 * Trait OrderDetailRepositoryTrait
 * @package App\Repositories
 */
trait OrderDetailRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $order = app()->make(Join::class);
        $order->class = Order::class;
        $order->foreign = 'order_detail.orderDetailOrderId';
        $order->type = 'inner';
        $order->primary = 'order.orderId';
        $this->joinTable['order'] = $order;

        $event = app()->make(Join::class);
        $event->class = Event::class;
        $event->foreign = 'order_detail.orderDetailEventId';
        $event->type = 'inner';
        $event->primary = 'event.eventId';
        $this->joinTable['event'] = $event;

    }

    /**
     * @inheritDoc
     */
    public function store(OrderDetailRepositoryRequest $orderDetailRepositoryRequest, OrderDetail $orderDetail): ?OrderDetail
    {
        try {
            $orderDetail = Lazy::transform($orderDetailRepositoryRequest, $orderDetail);
            $orderDetail->save();
            return $orderDetail;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $orderDetailId, OrderDetailRepositoryRequest $orderDetailRepositoryRequest, OrderDetail $orderDetail): ?OrderDetail
    {
        $orderDetail = $orderDetail->where('orderDetailId', $orderDetailId)->first();
        if($orderDetail != null){
            try {
                $orderDetail = Lazy::transform($orderDetailRepositoryRequest, $orderDetail);
                $orderDetail->save();
                return $orderDetail;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $orderDetail;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $orderDetailId, OrderDetail $orderDetail): bool
    {
        $orderDetail = $orderDetail->where('order_detail.orderDetailId',$orderDetailId)->first();
        if($orderDetail!=null){
            return $orderDetail->delete();
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
    public function get(OrderDetail $orderDetail, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderDetail)
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
    public function getCount(OrderDetail $orderDetail, string $q = null): int
    {
        return $this
            ->getJoin($orderDetail)
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
    public function getByOrderDetailId(int $orderDetailId, OrderDetail $orderDetail):? OrderDetail
    {
        return $this
            ->getJoin($orderDetail)
            ->where('order_detail.orderDetailId', '=', $orderDetailId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderDetailIdList(int $orderDetailId, OrderDetail $orderDetail, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderDetail)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('order_detail.orderDetailId', '=', $orderDetailId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderOrderId(int $orderId, OrderDetail $orderDetail):? OrderDetail
    {
        return $this
            ->getJoin($orderDetail)
            ->where('order.orderId', '=', $orderId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderOrderIdList(int $orderId, OrderDetail $orderDetail, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderDetail)
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
    public function getByEventEventId(int $eventId, OrderDetail $orderDetail):? OrderDetail
    {
        return $this
            ->getJoin($orderDetail)
            ->where('event.eventId', '=', $eventId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, OrderDetail $orderDetail, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderDetail)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event.eventId', '=', $eventId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
