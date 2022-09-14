<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfGroup;
use App\Models\SfGroupMenu;
use App\Repositories\Requests\SfGroupMenuRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:26
 * Time: 2022/09/14
 * Trait SfGroupMenuRepositoryTrait
 * @package App\Repositories
 */
trait SfGroupMenuRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $sf_group = app()->make(Join::class);
        $sf_group->class = SfGroup::class;
        $sf_group->foreign = 'sf_group_menu.groupId';
        $sf_group->type = 'left';
        $sf_group->primary = 'sf_group.groupId';
        $this->joinTable['sf_group'] = $sf_group;

        $sf_menu = app()->make(Join::class);
        $sf_menu->class = SfMenu::class;
        $sf_menu->foreign = 'sf_group_menu.menuId';
        $sf_menu->type = 'left';
        $sf_menu->primary = 'sf_menu.menuId';
        $this->joinTable['sf_menu'] = $sf_menu;

    }

    /**
     * @inheritDoc
     */
    public function store(SfGroupMenuRepositoryRequest $sfGroupMenuRepositoryRequest, SfGroupMenu $sfGroupMenu): ?SfGroupMenu
    {
        try {
            $sfGroupMenu = Lazy::transform($sfGroupMenuRepositoryRequest, $sfGroupMenu);
            $sfGroupMenu->save();
            return $sfGroupMenu;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $groupMenuId, SfGroupMenuRepositoryRequest $sfGroupMenuRepositoryRequest, SfGroupMenu $sfGroupMenu): ?SfGroupMenu
    {
        $sfGroupMenu = $sfGroupMenu->where('groupMenuId', $groupMenuId)->first();
        if($sfGroupMenu != null){
            try {
                $sfGroupMenu = Lazy::transform($sfGroupMenuRepositoryRequest, $sfGroupMenu);
                $sfGroupMenu->save();
                return $sfGroupMenu;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfGroupMenu;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $groupMenuId, SfGroupMenu $sfGroupMenu): bool
    {
        $sfGroupMenu = $sfGroupMenu->where('sf_group_menu.groupMenuId',$groupMenuId)->first();
        if($sfGroupMenu!=null){
            return $sfGroupMenu->delete();
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
    public function get(SfGroupMenu $sfGroupMenu, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroupMenu)
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
    public function getCount(SfGroupMenu $sfGroupMenu, string $q = null): int
    {
        return $this
            ->getJoin($sfGroupMenu)
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
    public function getByGroupMenuId(int $groupMenuId, SfGroupMenu $sfGroupMenu):? SfGroupMenu
    {
        return $this
            ->getJoin($sfGroupMenu)
            ->where('sf_group_menu.groupMenuId', '=', $groupMenuId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByGroupMenuIdList(int $groupMenuId, SfGroupMenu $sfGroupMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroupMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_group_menu.groupMenuId', '=', $groupMenuId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupId(int $groupId, SfGroupMenu $sfGroupMenu):? SfGroupMenu
    {
        return $this
            ->getJoin($sfGroupMenu)
            ->where('sf_group.groupId', '=', $groupId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfGroupGroupIdList(int $groupId, SfGroupMenu $sfGroupMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroupMenu)
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
    public function getBySfMenuMenuId(int $menuId, SfGroupMenu $sfGroupMenu):? SfGroupMenu
    {
        return $this
            ->getJoin($sfGroupMenu)
            ->where('sf_menu.menuId', '=', $menuId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getBySfMenuMenuIdList(int $menuId, SfGroupMenu $sfGroupMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfGroupMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('sf_menu.menuId', '=', $menuId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
