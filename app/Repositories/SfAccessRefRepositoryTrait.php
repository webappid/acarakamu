<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfAccessRef;
use App\Repositories\Requests\SfAccessRefRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:23
 * Time: 2022/09/14
 * Trait SfAccessRefRepositoryTrait
 * @package App\Repositories
 */
trait SfAccessRefRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfAccessRefRepositoryRequest $sfAccessRefRepositoryRequest, SfAccessRef $sfAccessRef): ?SfAccessRef
    {
        try {
            $sfAccessRef = Lazy::transform($sfAccessRefRepositoryRequest, $sfAccessRef);
            $sfAccessRef->save();
            return $sfAccessRef;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $accessId, SfAccessRefRepositoryRequest $sfAccessRefRepositoryRequest, SfAccessRef $sfAccessRef): ?SfAccessRef
    {
        $sfAccessRef = $sfAccessRef->where('accessId', $accessId)->first();
        if($sfAccessRef != null){
            try {
                $sfAccessRef = Lazy::transform($sfAccessRefRepositoryRequest, $sfAccessRef);
                $sfAccessRef->save();
                return $sfAccessRef;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfAccessRef;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $accessId, SfAccessRef $sfAccessRef): bool
    {
        $sfAccessRef = $sfAccessRef->where('sf_access_ref.accessId',$accessId)->first();
        if($sfAccessRef!=null){
            return $sfAccessRef->delete();
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
    public function get(SfAccessRef $sfAccessRef, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfAccessRef)
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
    public function getCount(SfAccessRef $sfAccessRef, string $q = null): int
    {
        return $this
            ->getJoin($sfAccessRef)
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
    public function getByAccessId(int $accessId, SfAccessRef $sfAccessRef):? SfAccessRef
    {
        return $this
            ->getJoin($sfAccessRef)
            ->where('sf_access_ref.accessId', '=', $accessId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAccessIdList(int $accessId, SfAccessRef $sfAccessRef, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfAccessRef)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_access_ref.accessId', '=', $accessId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
