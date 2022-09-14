<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Event;
use App\Models\EventHistory;
use App\Repositories\Requests\EventHistoryRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:02
 * Time: 2022/09/14
 * Trait EventHistoryRepositoryTrait
 * @package App\Repositories
 */
trait EventHistoryRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $event = app()->make(Join::class);
        $event->class = Event::class;
        $event->foreign = 'event_history.eventHitoryEventId';
        $event->type = 'inner';
        $event->primary = 'event.eventId';
        $this->joinTable['event'] = $event;

        $event_status_ref = app()->make(Join::class);
        $event_status_ref->class = EventStatusRef::class;
        $event_status_ref->foreign = 'event_history.eventHistoryStatusId';
        $event_status_ref->type = 'inner';
        $event_status_ref->primary = 'event_status_ref.eventStatusId';
        $this->joinTable['event_status_ref'] = $event_status_ref;

        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'event_history.eventHistoryUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(EventHistoryRepositoryRequest $eventHistoryRepositoryRequest, EventHistory $eventHistory): ?EventHistory
    {
        try {
            $eventHistory = Lazy::transform($eventHistoryRepositoryRequest, $eventHistory);
            $eventHistory->save();
            return $eventHistory;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventHistoryId, EventHistoryRepositoryRequest $eventHistoryRepositoryRequest, EventHistory $eventHistory): ?EventHistory
    {
        $eventHistory = $eventHistory->where('eventHistoryId', $eventHistoryId)->first();
        if($eventHistory != null){
            try {
                $eventHistory = Lazy::transform($eventHistoryRepositoryRequest, $eventHistory);
                $eventHistory->save();
                return $eventHistory;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $eventHistory;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventHistoryId, EventHistory $eventHistory): bool
    {
        $eventHistory = $eventHistory->where('event_history.eventHistoryId',$eventHistoryId)->first();
        if($eventHistory!=null){
            return $eventHistory->delete();
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
    public function get(EventHistory $eventHistory, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventHistory)
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
    public function getCount(EventHistory $eventHistory, string $q = null): int
    {
        return $this
            ->getJoin($eventHistory)
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
    public function getByEventHistoryId(int $eventHistoryId, EventHistory $eventHistory):? EventHistory
    {
        return $this
            ->getJoin($eventHistory)
            ->where('event_history.eventHistoryId', '=', $eventHistoryId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventHistoryIdList(int $eventHistoryId, EventHistory $eventHistory, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventHistory)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event_history.eventHistoryId', '=', $eventHistoryId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventId(int $eventId, EventHistory $eventHistory):? EventHistory
    {
        return $this
            ->getJoin($eventHistory)
            ->where('event.eventId', '=', $eventId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventEventIdList(int $eventId, EventHistory $eventHistory, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventHistory)
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
    public function getByEventStatusRefEventStatusId(int $eventStatusId, EventHistory $eventHistory):? EventHistory
    {
        return $this
            ->getJoin($eventHistory)
            ->where('event_status_ref.eventStatusId', '=', $eventStatusId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventStatusRefEventStatusIdList(int $eventStatusId, EventHistory $eventHistory, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventHistory)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event_status_ref.eventStatusId', '=', $eventStatusId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserName(string $userName, EventHistory $eventHistory):? EventHistory
    {
        return $this
            ->getJoin($eventHistory)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, EventHistory $eventHistory, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventHistory)
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
    public function getBySfUserUserId(int $userId, EventHistory $eventHistory):? EventHistory
    {
        return $this
            ->getJoin($eventHistory)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, EventHistory $eventHistory, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventHistory)
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
