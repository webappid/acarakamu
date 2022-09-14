<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfGroup;
use App\Models\SfGroupModule;
use App\Repositories\Requests\SfGroupModuleRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:27
 * Time: 2022/09/14
 * Trait SfGroupModuleRepositoryTrait
 * @package App\Repositories
 */
trait SfGroupModuleRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_group = app()->make(Join::class);
        $sf_group->class = SfGroup::class;
        $sf_group->foreign = 'sf_group_module.groupId';
        $sf_group->type = 'inner';
        $sf_group->primary = 'sf_group.groupId';
        $this->joinTable['sf_group'] = $sf_group;

        $sf_module = app()->make(Join::class);
        $sf_module->class = SfModule::class;
        $sf_module->foreign = 'sf_group_module.moduleId';
        $sf_module->type = 'inner';
        $sf_module->primary = 'sf_module.moduleId';
        $this->joinTable['sf_module'] = $sf_module;

    }

    /**
     * @inheritDoc
     */
    public function store(SfGroupModuleRepositoryRequest $sfGroupModuleRepositoryRequest, SfGroupModule $sfGroupModule): ?SfGroupModule
    {
        try {
            $sfGroupModule = Lazy::transform($sfGroupModuleRepositoryRequest, $sfGroupModule);
            $sfGroupModule->save();
            return $sfGroupModule;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $groupModId, SfGroupModuleRepositoryRequest $sfGroupModuleRepositoryRequest, SfGroupModule $sfGroupModule): ?SfGroupModule
    {
        $sfGroupModule = $sfGroupModule->where('groupModId', $groupModId)->first();
        if($sfGroupModule != null){
            try {
                $sfGroupModule = Lazy::transform($sfGroupModuleRepositoryRequest, $sfGroupModule);
                $sfGroupModule->save();
                return $sfGroupModule;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfGroupModule;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $groupModId, SfGroupModule $sfGroupModule): bool
    {
        $sfGroupModule = $sfGroupModule->where('sf_group_module.groupModId',$groupModId)->first();
        if($sfGroupModule!=null){
            return $sfGroupModule->delete();
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
    public function get(SfGroupModule $sfGroupModule, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroupModule)
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
    public function getCount(SfGroupModule $sfGroupModule, string $q = null): int
    {
        return $this
            ->getJoin($sfGroupModule)
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
    public function getByGroupModId(int $groupModId, SfGroupModule $sfGroupModule):? SfGroupModule
    {
        return $this
            ->getJoin($sfGroupModule)
            ->where('sf_group_module.groupModId', '=', $groupModId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByGroupModIdList(int $groupModId, SfGroupModule $sfGroupModule, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroupModule)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_group_module.groupModId', '=', $groupModId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupId(int $groupId, SfGroupModule $sfGroupModule):? SfGroupModule
    {
        return $this
            ->getJoin($sfGroupModule)
            ->where('sf_group.groupId', '=', $groupId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupIdList(int $groupId, SfGroupModule $sfGroupModule, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroupModule)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_group.groupId', '=', $groupId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfModuleModuleCode(string $moduleCode, SfGroupModule $sfGroupModule):? SfGroupModule
    {
        return $this
            ->getJoin($sfGroupModule)
            ->where('sf_module.moduleCode', '=', $moduleCode )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfModuleModuleCodeList(string $moduleCode, SfGroupModule $sfGroupModule, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroupModule)
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
    public function getBySfModuleModuleId(int $moduleId, SfGroupModule $sfGroupModule):? SfGroupModule
    {
        return $this
            ->getJoin($sfGroupModule)
            ->where('sf_module.moduleId', '=', $moduleId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfModuleModuleIdList(int $moduleId, SfGroupModule $sfGroupModule, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroupModule)
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
