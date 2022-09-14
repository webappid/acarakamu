<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AdsOrder;
use App\Repositories\Requests\AdsOrderRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:03:55
 * Time: 2022/09/14
 * Trait AdsOrderRepositoryTrait
 * @package App\Repositories
 */
trait AdsOrderRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'ads_order.adsOrderUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

        $order_status = app()->make(Join::class);
        $order_status->class = OrderStatus::class;
        $order_status->foreign = 'ads_order.adsOrderStatusId';
        $order_status->type = 'inner';
        $order_status->primary = 'order_status.orderStatusId';
        $this->joinTable['order_status'] = $order_status;

    }

    /**
     * @inheritDoc
     */
    public function store(AdsOrderRepositoryRequest $adsOrderRepositoryRequest, AdsOrder $adsOrder): ?AdsOrder
    {
        try {
            $adsOrder = Lazy::transform($adsOrderRepositoryRequest, $adsOrder);
            $adsOrder->save();
            return $adsOrder;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $adsOrderId, AdsOrderRepositoryRequest $adsOrderRepositoryRequest, AdsOrder $adsOrder): ?AdsOrder
    {
        $adsOrder = $adsOrder->where('adsOrderId', $adsOrderId)->first();
        if($adsOrder != null){
            try {
                $adsOrder = Lazy::transform($adsOrderRepositoryRequest, $adsOrder);
                $adsOrder->save();
                return $adsOrder;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $adsOrder;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $adsOrderId, AdsOrder $adsOrder): bool
    {
        $adsOrder = $adsOrder->where('ads_order.adsOrderId',$adsOrderId)->first();
        if($adsOrder!=null){
            return $adsOrder->delete();
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
    public function get(AdsOrder $adsOrder, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrder)
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
    public function getCount(AdsOrder $adsOrder, string $q = null): int
    {
        return $this
            ->getJoin($adsOrder)
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
    public function getByAdsOrderId(int $adsOrderId, AdsOrder $adsOrder):? AdsOrder
    {
        return $this
            ->getJoin($adsOrder)
            ->where('ads_order.adsOrderId', '=', $adsOrderId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderIdList(int $adsOrderId, AdsOrder $adsOrder, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrder)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('ads_order.adsOrderId', '=', $adsOrderId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, AdsOrder $adsOrder):? AdsOrder
    {
        return $this
            ->getJoin($adsOrder)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, AdsOrder $adsOrder, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrder)
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
    public function getBySfUserUserId(int $userId, AdsOrder $adsOrder):? AdsOrder
    {
        return $this
            ->getJoin($adsOrder)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, AdsOrder $adsOrder, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrder)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_user.userId', '=', $userId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusId(int $orderStatusId, AdsOrder $adsOrder):? AdsOrder
    {
        return $this
            ->getJoin($adsOrder)
            ->where('order_status.orderStatusId', '=', $orderStatusId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOrderStatusOrderStatusIdList(int $orderStatusId, AdsOrder $adsOrder, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrder)
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
