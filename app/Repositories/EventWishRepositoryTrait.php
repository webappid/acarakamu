<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Event;
use App\Models\EventWish;
use App\Repositories\Requests\EventWishRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:06
 * Time: 2022/09/14
 * Trait EventWishRepositoryTrait
 * @package App\Repositories
 */
trait EventWishRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $event = app()->make(Join::class);
        $event->class = Event::class;
        $event->foreign = 'event_wish.wishListEventId';
        $event->type = 'inner';
        $event->primary = 'event.eventId';
        $this->joinTable['event'] = $event;

        $member = app()->make(Join::class);
        $member->class = Member::class;
        $member->foreign = 'event_wish.wishListEventMemberId';
        $member->type = 'inner';
        $member->primary = 'member.memberId';
        $this->joinTable['member'] = $member;

    }

    /**
     * @inheritDoc
     */
    public function store(EventWishRepositoryRequest $eventWishRepositoryRequest, EventWish $eventWish): ?EventWish
    {
        try {
            $eventWish = Lazy::transform($eventWishRepositoryRequest, $eventWish);
            $eventWish->save();
            return $eventWish;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $wishListId, EventWishRepositoryRequest $eventWishRepositoryRequest, EventWish $eventWish): ?EventWish
    {
        $eventWish = $eventWish->where('wishListId', $wishListId)->first();
        if($eventWish != null){
            try {
                $eventWish = Lazy::transform($eventWishRepositoryRequest, $eventWish);
                $eventWish->save();
                return $eventWish;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $eventWish;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $wishListId, EventWish $eventWish): bool
    {
        $eventWish = $eventWish->where('event_wish.wishListId',$wishListId)->first();
        if($eventWish!=null){
            return $eventWish->delete();
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
    public function get(EventWish $eventWish, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventWish)
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
    public function getCount(EventWish $eventWish, string $q = null): int
    {
        return $this
            ->getJoin($eventWish)
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
    public function getByWishListEventIdWishListEventMemberId(int $wishListEventId, int $wishListEventMemberId, EventWish $eventWish):? EventWish
    {
        return $this
            ->getJoin($eventWish)
            ->where('event_wish.wishListEventId', '=', $wishListEventId )
            ->where('event_wish.wishListEventMemberId', '=', $wishListEventMemberId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByWishListEventIdWishListEventMemberIdList(int $wishListEventId, int $wishListEventMemberId, EventWish $eventWish, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventWish)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event_wish.wishListEventId', '=', $wishListEventId )
            ->where('event_wish.wishListEventMemberId', '=', $wishListEventMemberId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByWishListId(int $wishListId, EventWish $eventWish):? EventWish
    {
        return $this
            ->getJoin($eventWish)
            ->where('event_wish.wishListId', '=', $wishListId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByWishListIdList(int $wishListId, EventWish $eventWish, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventWish)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event_wish.wishListId', '=', $wishListId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, EventWish $eventWish):? EventWish
    {
        return $this
            ->getJoin($eventWish)
            ->where('event.eventId', '=', $eventId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, EventWish $eventWish, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventWish)
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
    public function getByMemberMemberId(int $memberId, EventWish $eventWish):? EventWish
    {
        return $this
            ->getJoin($eventWish)
            ->where('member.memberId', '=', $memberId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMemberMemberIdList(int $memberId, EventWish $eventWish, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventWish)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('member.memberId', '=', $memberId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
