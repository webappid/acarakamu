<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\EventStatusRef;
use App\Repositories\Requests\EventStatusRefRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:04
 * Time: 2022/09/14
 * Trait EventStatusRefRepositoryTrait
 * @package App\Repositories
 */
trait EventStatusRefRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_user = app()->make(Join::class);
        $sf_user->class = SfUser::class;
        $sf_user->foreign = 'event_status_ref.eventStatusUserId';
        $sf_user->type = 'inner';
        $sf_user->primary = 'sf_user.userId';
        $this->joinTable['sf_user'] = $sf_user;

    }

    /**
     * @inheritDoc
     */
    public function store(EventStatusRefRepositoryRequest $eventStatusRefRepositoryRequest, EventStatusRef $eventStatusRef): ?EventStatusRef
    {
        try {
            $eventStatusRef = Lazy::transform($eventStatusRefRepositoryRequest, $eventStatusRef);
            $eventStatusRef->save();
            return $eventStatusRef;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventStatusId, EventStatusRefRepositoryRequest $eventStatusRefRepositoryRequest, EventStatusRef $eventStatusRef): ?EventStatusRef
    {
        $eventStatusRef = $eventStatusRef->where('eventStatusId', $eventStatusId)->first();
        if($eventStatusRef != null){
            try {
                $eventStatusRef = Lazy::transform($eventStatusRefRepositoryRequest, $eventStatusRef);
                $eventStatusRef->save();
                return $eventStatusRef;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $eventStatusRef;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventStatusId, EventStatusRef $eventStatusRef): bool
    {
        $eventStatusRef = $eventStatusRef->where('event_status_ref.eventStatusId',$eventStatusId)->first();
        if($eventStatusRef!=null){
            return $eventStatusRef->delete();
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
    public function get(EventStatusRef $eventStatusRef, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventStatusRef)
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
    public function getCount(EventStatusRef $eventStatusRef, string $q = null): int
    {
        return $this
            ->getJoin($eventStatusRef)
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
    public function getByEventStatusId(int $eventStatusId, EventStatusRef $eventStatusRef):? EventStatusRef
    {
        return $this
            ->getJoin($eventStatusRef)
            ->where('event_status_ref.eventStatusId', '=', $eventStatusId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventStatusIdList(int $eventStatusId, EventStatusRef $eventStatusRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventStatusRef)
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
    public function getBySfUserUserName(string $userName, EventStatusRef $eventStatusRef):? EventStatusRef
    {
        return $this
            ->getJoin($eventStatusRef)
            ->where('sf_user.userName', '=', $userName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserNameList(string $userName, EventStatusRef $eventStatusRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventStatusRef)
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
    public function getBySfUserUserId(int $userId, EventStatusRef $eventStatusRef):? EventStatusRef
    {
        return $this
            ->getJoin($eventStatusRef)
            ->where('sf_user.userId', '=', $userId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfUserUserIdList(int $userId, EventStatusRef $eventStatusRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventStatusRef)
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
