<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfGroup;
use App\Repositories\Requests\SfGroupRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:25
 * Time: 2022/09/14
 * Trait SfGroupRepositoryTrait
 * @package App\Repositories
 */
trait SfGroupRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfGroupRepositoryRequest $sfGroupRepositoryRequest, SfGroup $sfGroup): ?SfGroup
    {
        try {
            $sfGroup = Lazy::transform($sfGroupRepositoryRequest, $sfGroup);
            $sfGroup->save();
            return $sfGroup;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $groupId, SfGroupRepositoryRequest $sfGroupRepositoryRequest, SfGroup $sfGroup): ?SfGroup
    {
        $sfGroup = $sfGroup->where('groupId', $groupId)->first();
        if($sfGroup != null){
            try {
                $sfGroup = Lazy::transform($sfGroupRepositoryRequest, $sfGroup);
                $sfGroup->save();
                return $sfGroup;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfGroup;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $groupId, SfGroup $sfGroup): bool
    {
        $sfGroup = $sfGroup->where('sf_group.groupId',$groupId)->first();
        if($sfGroup!=null){
            return $sfGroup->delete();
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
    public function get(SfGroup $sfGroup, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroup)
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
    public function getCount(SfGroup $sfGroup, string $q = null): int
    {
        return $this
            ->getJoin($sfGroup)
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
    public function getByGroupId(int $groupId, SfGroup $sfGroup):? SfGroup
    {
        return $this
            ->getJoin($sfGroup)
            ->where('sf_group.groupId', '=', $groupId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByGroupIdList(int $groupId, SfGroup $sfGroup, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroup)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_group.groupId', '=', $groupId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
