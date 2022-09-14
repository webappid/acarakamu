<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AdsOrder;
use App\Models\AdsOrderDetail;
use App\Repositories\Requests\AdsOrderDetailRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:03:56
 * Time: 2022/09/14
 * Trait AdsOrderDetailRepositoryTrait
 * @package App\Repositories
 */
trait AdsOrderDetailRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $ads_order = app()->make(Join::class);
        $ads_order->class = AdsOrder::class;
        $ads_order->foreign = 'ads_order_detail.adsOrderDetailAdsOrderId';
        $ads_order->type = 'inner';
        $ads_order->primary = 'ads_order.adsOrderId';
        $this->joinTable['ads_order'] = $ads_order;

        $event = app()->make(Join::class);
        $event->class = Event::class;
        $event->foreign = 'ads_order_detail.adsOrderDetailAdsEventId';
        $event->type = 'inner';
        $event->primary = 'event.eventId';
        $this->joinTable['event'] = $event;

        $ads_ref_price = app()->make(Join::class);
        $ads_ref_price->class = AdsRefPrice::class;
        $ads_ref_price->foreign = 'ads_order_detail.adsOrderDetailAdsRefPriceId';
        $ads_ref_price->type = 'inner';
        $ads_ref_price->primary = 'ads_ref_price.adsPriceRefId';
        $this->joinTable['ads_ref_price'] = $ads_ref_price;

    }

    /**
     * @inheritDoc
     */
    public function store(AdsOrderDetailRepositoryRequest $adsOrderDetailRepositoryRequest, AdsOrderDetail $adsOrderDetail): ?AdsOrderDetail
    {
        try {
            $adsOrderDetail = Lazy::transform($adsOrderDetailRepositoryRequest, $adsOrderDetail);
            $adsOrderDetail->save();
            return $adsOrderDetail;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $adsOrderDetailId, AdsOrderDetailRepositoryRequest $adsOrderDetailRepositoryRequest, AdsOrderDetail $adsOrderDetail): ?AdsOrderDetail
    {
        $adsOrderDetail = $adsOrderDetail->where('adsOrderDetailId', $adsOrderDetailId)->first();
        if($adsOrderDetail != null){
            try {
                $adsOrderDetail = Lazy::transform($adsOrderDetailRepositoryRequest, $adsOrderDetail);
                $adsOrderDetail->save();
                return $adsOrderDetail;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $adsOrderDetail;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $adsOrderDetailId, AdsOrderDetail $adsOrderDetail): bool
    {
        $adsOrderDetail = $adsOrderDetail->where('ads_order_detail.adsOrderDetailId',$adsOrderDetailId)->first();
        if($adsOrderDetail!=null){
            return $adsOrderDetail->delete();
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
    public function get(AdsOrderDetail $adsOrderDetail, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrderDetail)
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
    public function getCount(AdsOrderDetail $adsOrderDetail, string $q = null): int
    {
        return $this
            ->getJoin($adsOrderDetail)
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
    public function getByAdsOrderDetailId(int $adsOrderDetailId, AdsOrderDetail $adsOrderDetail):? AdsOrderDetail
    {
        return $this
            ->getJoin($adsOrderDetail)
            ->where('ads_order_detail.adsOrderDetailId', '=', $adsOrderDetailId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderDetailIdList(int $adsOrderDetailId, AdsOrderDetail $adsOrderDetail, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrderDetail)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('ads_order_detail.adsOrderDetailId', '=', $adsOrderDetailId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderAdsOrderId(int $adsOrderId, AdsOrderDetail $adsOrderDetail):? AdsOrderDetail
    {
        return $this
            ->getJoin($adsOrderDetail)
            ->where('ads_order.adsOrderId', '=', $adsOrderId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderAdsOrderIdList(int $adsOrderId, AdsOrderDetail $adsOrderDetail, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrderDetail)
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
    public function getByEventEventId(int $eventId, AdsOrderDetail $adsOrderDetail):? AdsOrderDetail
    {
        return $this
            ->getJoin($adsOrderDetail)
            ->where('event.eventId', '=', $eventId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, AdsOrderDetail $adsOrderDetail, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrderDetail)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event.eventId', '=', $eventId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAdsRefPriceAdsPriceRefId(int $adsPriceRefId, AdsOrderDetail $adsOrderDetail):? AdsOrderDetail
    {
        return $this
            ->getJoin($adsOrderDetail)
            ->where('ads_ref_price.adsPriceRefId', '=', $adsPriceRefId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAdsRefPriceAdsPriceRefIdList(int $adsPriceRefId, AdsOrderDetail $adsOrderDetail, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsOrderDetail)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('ads_ref_price.adsPriceRefId', '=', $adsPriceRefId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
