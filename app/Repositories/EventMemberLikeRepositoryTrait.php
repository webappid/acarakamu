<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\EventMemberLike;
use App\Repositories\Requests\EventMemberLikeRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:03
 * Time: 2022/09/14
 * Trait EventMemberLikeRepositoryTrait
 * @package App\Repositories
 */
trait EventMemberLikeRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(EventMemberLikeRepositoryRequest $eventMemberLikeRepositoryRequest, EventMemberLike $eventMemberLike): ?EventMemberLike
    {
        try {
            $eventMemberLike = Lazy::transform($eventMemberLikeRepositoryRequest, $eventMemberLike);
            $eventMemberLike->save();
            return $eventMemberLike;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $eventMemberLikeId, EventMemberLikeRepositoryRequest $eventMemberLikeRepositoryRequest, EventMemberLike $eventMemberLike): ?EventMemberLike
    {
        $eventMemberLike = $eventMemberLike->where('eventMemberLikeId', $eventMemberLikeId)->first();
        if($eventMemberLike != null){
            try {
                $eventMemberLike = Lazy::transform($eventMemberLikeRepositoryRequest, $eventMemberLike);
                $eventMemberLike->save();
                return $eventMemberLike;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $eventMemberLike;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $eventMemberLikeId, EventMemberLike $eventMemberLike): bool
    {
        $eventMemberLike = $eventMemberLike->where('event_member_like.eventMemberLikeId',$eventMemberLikeId)->first();
        if($eventMemberLike!=null){
            return $eventMemberLike->delete();
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
    public function get(EventMemberLike $eventMemberLike, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventMemberLike)
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
    public function getCount(EventMemberLike $eventMemberLike, string $q = null): int
    {
        return $this
            ->getJoin($eventMemberLike)
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
    public function getByEventMemberLikeId(int $eventMemberLikeId, EventMemberLike $eventMemberLike):? EventMemberLike
    {
        return $this
            ->getJoin($eventMemberLike)
            ->where('event_member_like.eventMemberLikeId', '=', $eventMemberLikeId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByEventMemberLikeIdList(int $eventMemberLikeId, EventMemberLike $eventMemberLike, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($eventMemberLike)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('event_member_like.eventMemberLikeId', '=', $eventMemberLikeId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
