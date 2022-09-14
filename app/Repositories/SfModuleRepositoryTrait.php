<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfModule;
use App\Repositories\Requests\SfModuleRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:40
 * Time: 2022/09/14
 * Trait SfModuleRepositoryTrait
 * @package App\Repositories
 */
trait SfModuleRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfModuleRepositoryRequest $sfModuleRepositoryRequest, SfModule $sfModule): ?SfModule
    {
        try {
            $sfModule = Lazy::transform($sfModuleRepositoryRequest, $sfModule);
            $sfModule->save();
            return $sfModule;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $moduleCode, SfModuleRepositoryRequest $sfModuleRepositoryRequest, SfModule $sfModule): ?SfModule
    {
        $sfModule = $sfModule->where('moduleCode', $moduleCode)->first();
        if($sfModule != null){
            try {
                $sfModule = Lazy::transform($sfModuleRepositoryRequest, $sfModule);
                $sfModule->save();
                return $sfModule;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfModule;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $moduleCode, SfModule $sfModule): bool
    {
        $sfModule = $sfModule->where('sf_module.moduleCode',$moduleCode)->first();
        if($sfModule!=null){
            return $sfModule->delete();
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
            return $query->where('sf_module.moduleCode', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(SfModule $sfModule, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfModule)
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
    public function getCount(SfModule $sfModule, string $q = null): int
    {
        return $this
            ->getJoin($sfModule)
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
    public function getByModuleCode(string $moduleCode, SfModule $sfModule):? SfModule
    {
        return $this
            ->getJoin($sfModule)
            ->where('sf_module.moduleCode', '=', $moduleCode )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByModuleCodeList(string $moduleCode, SfModule $sfModule, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfModule)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_module.moduleCode', '=', $moduleCode )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByModuleId(int $moduleId, SfModule $sfModule):? SfModule
    {
        return $this
            ->getJoin($sfModule)
            ->where('sf_module.moduleId', '=', $moduleId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByModuleIdList(int $moduleId, SfModule $sfModule, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfModule)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_module.moduleId', '=', $moduleId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
