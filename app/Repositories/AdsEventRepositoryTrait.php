<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AdsEvent;
use App\Repositories\Requests\AdsEventRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:03:54
 * Time: 2022/09/14
 * Trait AdsEventRepositoryTrait
 * @package App\Repositories
 */
trait AdsEventRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $event = app()->make(Join::class);
        $event->class = Event::class;
        $event->foreign = 'ads_event.adsEventEventId';
        $event->type = 'inner';
        $event->primary = 'event.eventId';
        $this->joinTable['event'] = $event;

        $ads_order = app()->make(Join::class);
        $ads_order->class = AdsOrder::class;
        $ads_order->foreign = 'ads_event.adsEventAdsOrderId';
        $ads_order->type = 'inner';
        $ads_order->primary = 'ads_order.adsOrderId';
        $this->joinTable['ads_order'] = $ads_order;

        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'ads_event.adsEventUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(AdsEventRepositoryRequest $adsEventRepositoryRequest, AdsEvent $adsEvent): ?AdsEvent
    {
        try {
            $adsEvent = Lazy::transform($adsEventRepositoryRequest, $adsEvent);
            $adsEvent->save();
            return $adsEvent;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $adsEventId, AdsEventRepositoryRequest $adsEventRepositoryRequest, AdsEvent $adsEvent): ?AdsEvent
    {
        $adsEvent = $adsEvent->where('adsEventId', $adsEventId)->first();
        if($adsEvent != null){
            try {
                $adsEvent = Lazy::transform($adsEventRepositoryRequest, $adsEvent);
                $adsEvent->save();
                return $adsEvent;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $adsEvent;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $adsEventId, AdsEvent $adsEvent): bool
    {
        $adsEvent = $adsEvent->where('ads_event.adsEventId',$adsEventId)->first();
        if($adsEvent!=null){
            return $adsEvent->delete();
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
    public function get(AdsEvent $adsEvent, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsEvent)
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
    public function getCount(AdsEvent $adsEvent, string $q = null): int
    {
        return $this
            ->getJoin($adsEvent)
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
    public function getByAdsEventId(int $adsEventId, AdsEvent $adsEvent):? AdsEvent
    {
        return $this
            ->getJoin($adsEvent)
            ->where('ads_event.adsEventId', '=', $adsEventId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAdsEventIdList(int $adsEventId, AdsEvent $adsEvent, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsEvent)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('ads_event.adsEventId', '=', $adsEventId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, AdsEvent $adsEvent):? AdsEvent
    {
        return $this
            ->getJoin($adsEvent)
            ->where('event.eventId', '=', $eventId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, AdsEvent $adsEvent, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsEvent)
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
    public function getByAdsOrderAdsOrderId(int $adsOrderId, AdsEvent $adsEvent):? AdsEvent
    {
        return $this
            ->getJoin($adsEvent)
            ->where('ads_order.adsOrderId', '=', $adsOrderId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAdsOrderAdsOrderIdList(int $adsOrderId, AdsEvent $adsEvent, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsEvent)
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
    public function getBySfUserUserName(string $userName, AdsEvent $adsEvent):? AdsEvent
    {
        return $this
            ->getJoin($adsEvent)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, AdsEvent $adsEvent, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsEvent)
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
    public function getBySfUserUserId(int $userId, AdsEvent $adsEvent):? AdsEvent
    {
        return $this
            ->getJoin($adsEvent)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, AdsEvent $adsEvent, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($adsEvent)
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
