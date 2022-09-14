<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\SfMenu;
use App\Repositories\Requests\SfMenuRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 16:04:31
 * Time: 2022/09/14
 * Trait SfMenuRepositoryTrait
 * @package App\Repositories
 */
trait SfMenuRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){

    }

    /**
     * @inheritDoc
     */
    public function store(SfMenuRepositoryRequest $sfMenuRepositoryRequest, SfMenu $sfMenu): ?SfMenu
    {
        try {
            $sfMenu = Lazy::transform($sfMenuRepositoryRequest, $sfMenu);
            $sfMenu->save();
            return $sfMenu;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $menuId, SfMenuRepositoryRequest $sfMenuRepositoryRequest, SfMenu $sfMenu): ?SfMenu
    {
        $sfMenu = $sfMenu->where('menuId', $menuId)->first();
        if($sfMenu != null){
            try {
                $sfMenu = Lazy::transform($sfMenuRepositoryRequest, $sfMenu);
                $sfMenu->save();
                return $sfMenu;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $sfMenu;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $menuId, SfMenu $sfMenu): bool
    {
        $sfMenu = $sfMenu->where('sf_menu.menuId',$menuId)->first();
        if($sfMenu!=null){
            return $sfMenu->delete();
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
    public function get(SfMenu $sfMenu, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMenu)
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
    public function getCount(SfMenu $sfMenu, string $q = null): int
    {
        return $this
            ->getJoin($sfMenu)
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
    public function getByMenuId(int $menuId, SfMenu $sfMenu):? SfMenu
    {
        return $this
            ->getJoin($sfMenu)
            ->where('sf_menu.menuId', '=', $menuId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMenuIdList(int $menuId, SfMenu $sfMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($sfMenu)
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
