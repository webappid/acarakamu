<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfMicroprocessRefParam;
use App\Repositories\Requests\SfMicroprocessRefParamRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:37
 * Time: 2022/09/14
 * Trait SfMicroprocessRefParamRepositoryTrait
 * @package App\Repositories
 */
trait SfMicroprocessRefParamRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfMicroprocessRefParamRepositoryRequest $sfMicroprocessRefParamRepositoryRequest, SfMicroprocessRefParam $sfMicroprocessRefParam): ?SfMicroprocessRefParam
    {
        try {
            $sfMicroprocessRefParam = Lazy::transform($sfMicroprocessRefParamRepositoryRequest, $sfMicroprocessRefParam);
            $sfMicroprocessRefParam->save();
            return $sfMicroprocessRefParam;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $paramName, SfMicroprocessRefParamRepositoryRequest $sfMicroprocessRefParamRepositoryRequest, SfMicroprocessRefParam $sfMicroprocessRefParam): ?SfMicroprocessRefParam
    {
        $sfMicroprocessRefParam = $sfMicroprocessRefParam->where('paramName', $paramName)->first();
        if($sfMicroprocessRefParam != null){
            try {
                $sfMicroprocessRefParam = Lazy::transform($sfMicroprocessRefParamRepositoryRequest, $sfMicroprocessRefParam);
                $sfMicroprocessRefParam->save();
                return $sfMicroprocessRefParam;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfMicroprocessRefParam;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $paramName, SfMicroprocessRefParam $sfMicroprocessRefParam): bool
    {
        $sfMicroprocessRefParam = $sfMicroprocessRefParam->where('sf_microprocess_ref_param.paramName',$paramName)->first();
        if($sfMicroprocessRefParam!=null){
            return $sfMicroprocessRefParam->delete();
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
            return $query->where('sf_microprocess_ref_param.paramName', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(SfMicroprocessRefParam $sfMicroprocessRefParam, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessRefParam)
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
    public function getCount(SfMicroprocessRefParam $sfMicroprocessRefParam, string $q = null): int
    {
        return $this
            ->getJoin($sfMicroprocessRefParam)
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
    public function getByParamName(string $paramName, SfMicroprocessRefParam $sfMicroprocessRefParam):? SfMicroprocessRefParam
    {
        return $this
            ->getJoin($sfMicroprocessRefParam)
            ->where('sf_microprocess_ref_param.paramName', '=', $paramName )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByParamNameList(string $paramName, SfMicroprocessRefParam $sfMicroprocessRefParam, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessRefParam)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_ref_param.paramName', '=', $paramName )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByParamId(int $paramId, SfMicroprocessRefParam $sfMicroprocessRefParam):? SfMicroprocessRefParam
    {
        return $this
            ->getJoin($sfMicroprocessRefParam)
            ->where('sf_microprocess_ref_param.paramId', '=', $paramId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByParamIdList(int $paramId, SfMicroprocessRefParam $sfMicroprocessRefParam, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMicroprocessRefParam)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_microprocess_ref_param.paramId', '=', $paramId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
