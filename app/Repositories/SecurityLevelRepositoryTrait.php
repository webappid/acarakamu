<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SecurityLevel;
use App\Repositories\Requests\SecurityLevelRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:03:53
 * Time: 2022/09/14
 * Trait SecurityLevelRepositoryTrait
 * @package App\Repositories
 */
trait SecurityLevelRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SecurityLevelRepositoryRequest $securityLevelRepositoryRequest, SecurityLevel $securityLevel): ?SecurityLevel
    {
        try {
            $securityLevel = Lazy::transform($securityLevelRepositoryRequest, $securityLevel);
            $securityLevel->save();
            return $securityLevel;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $Id, SecurityLevelRepositoryRequest $securityLevelRepositoryRequest, SecurityLevel $securityLevel): ?SecurityLevel
    {
        $securityLevel = $securityLevel->where('Id', $Id)->first();
        if($securityLevel != null){
            try {
                $securityLevel = Lazy::transform($securityLevelRepositoryRequest, $securityLevel);
                $securityLevel->save();
                return $securityLevel;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $securityLevel;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $Id, SecurityLevel $securityLevel): bool
    {
        $securityLevel = $securityLevel->where('SecurityLevel.Id',$Id)->first();
        if($securityLevel!=null){
            return $securityLevel->delete();
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
    public function get(SecurityLevel $securityLevel, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($securityLevel)
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
    public function getCount(SecurityLevel $securityLevel, string $q = null): int
    {
        return $this
            ->getJoin($securityLevel)
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
    public function getById(int $id, SecurityLevel $securityLevel):? SecurityLevel
    {
        return $this
            ->getJoin($securityLevel)
            ->where('SecurityLevel.Id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, SecurityLevel $securityLevel, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($securityLevel)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('SecurityLevel.Id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
