<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\OrderStatus;
use App\Repositories\Requests\OrderStatusRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:16
 * Time: 2022/09/14
 * Trait OrderStatusRepositoryTrait
 * @package App\Repositories
 */
trait OrderStatusRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(OrderStatusRepositoryRequest $orderStatusRepositoryRequest, OrderStatus $orderStatus): ?OrderStatus
    {
        try {
            $orderStatus = Lazy::transform($orderStatusRepositoryRequest, $orderStatus);
            $orderStatus->save();
            return $orderStatus;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $orderStatusId, OrderStatusRepositoryRequest $orderStatusRepositoryRequest, OrderStatus $orderStatus): ?OrderStatus
    {
        $orderStatus = $orderStatus->where('orderStatusId', $orderStatusId)->first();
        if($orderStatus != null){
            try {
                $orderStatus = Lazy::transform($orderStatusRepositoryRequest, $orderStatus);
                $orderStatus->save();
                return $orderStatus;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $orderStatus;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $orderStatusId, OrderStatus $orderStatus): bool
    {
        $orderStatus = $orderStatus->where('order_status.orderStatusId',$orderStatusId)->first();
        if($orderStatus!=null){
            return $orderStatus->delete();
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
    public function get(OrderStatus $orderStatus, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderStatus)
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
    public function getCount(OrderStatus $orderStatus, string $q = null): int
    {
        return $this
            ->getJoin($orderStatus)
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
    public function getByOrderStatusId(int $orderStatusId, OrderStatus $orderStatus):? OrderStatus
    {
        return $this
            ->getJoin($orderStatus)
            ->where('order_status.orderStatusId', '=', $orderStatusId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusIdList(int $orderStatusId, OrderStatus $orderStatus, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($orderStatus)
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
