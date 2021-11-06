<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AppMenuCategoryMenu;
use App\Repositories\Requests\AppMenuCategoryMenuRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:03:58
 * Time: 2021/11/06
 * Trait AppMenuCategoryMenuRepositoryTrait
 * @package App\Repositories
 */
trait AppMenuCategoryMenuRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $app_menu_categories = app()->make(Join::class);
        $app_menu_categories->class = AppMenuCategory::class;
        $app_menu_categories->foreign = 'app_menu_category_menus.menu_category_id';
        $app_menu_categories->type = 'inner';
        $app_menu_categories->primary = 'app_menu_categories.id';
        $this->joinTable['app_menu_categories'] = $app_menu_categories;

        $app_menus = app()->make(Join::class);
        $app_menus->class = AppMenu::class;
        $app_menus->foreign = 'app_menu_category_menus.menu_id';
        $app_menus->type = 'inner';
        $app_menus->primary = 'app_menus.id';
        $this->joinTable['app_menus'] = $app_menus;

    }

    /**
     * @inheritDoc
     */
    public function store(AppMenuCategoryMenuRepositoryRequest $appMenuCategoryMenuRepositoryRequest, AppMenuCategoryMenu $appMenuCategoryMenu): ?AppMenuCategoryMenu
    {
        try {
            $appMenuCategoryMenu = Lazy::transform($appMenuCategoryMenuRepositoryRequest, $appMenuCategoryMenu);
            $appMenuCategoryMenu->save();
            return $appMenuCategoryMenu;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppMenuCategoryMenuRepositoryRequest $appMenuCategoryMenuRepositoryRequest, AppMenuCategoryMenu $appMenuCategoryMenu): ?AppMenuCategoryMenu
    {
        $appMenuCategoryMenu = $appMenuCategoryMenu->where('id', $id)->first();
        if($appMenuCategoryMenu != null){
            try {
                $appMenuCategoryMenu = Lazy::transform($appMenuCategoryMenuRepositoryRequest, $appMenuCategoryMenu);
                $appMenuCategoryMenu->save();
                return $appMenuCategoryMenu;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $appMenuCategoryMenu;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppMenuCategoryMenu $appMenuCategoryMenu): bool
    {
        $appMenuCategoryMenu = $appMenuCategoryMenu->where('app_menu_category_menus.id',$id)->first();
        if($appMenuCategoryMenu!=null){
            return $appMenuCategoryMenu->delete();
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
    public function get(AppMenuCategoryMenu $appMenuCategoryMenu, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
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
    public function getCount(AppMenuCategoryMenu $appMenuCategoryMenu, string $q = null): int
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
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
    public function getById(int $id, AppMenuCategoryMenu $appMenuCategoryMenu):? AppMenuCategoryMenu
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->where('app_menu_category_menus.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppMenuCategoryMenu $appMenuCategoryMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_menu_category_menus.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuCategoryName(string $name, AppMenuCategoryMenu $appMenuCategoryMenu):? AppMenuCategoryMenu
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->where('app_menu_categories.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuCategoryNameList(string $name, AppMenuCategoryMenu $appMenuCategoryMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_menu_categories.name', '=', $name )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuCategoryId(int $id, AppMenuCategoryMenu $appMenuCategoryMenu):? AppMenuCategoryMenu
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->where('app_menu_categories.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuCategoryIdList(int $id, AppMenuCategoryMenu $appMenuCategoryMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_menu_categories.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuName(string $name, AppMenuCategoryMenu $appMenuCategoryMenu):? AppMenuCategoryMenu
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->where('app_menus.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuNameList(string $name, AppMenuCategoryMenu $appMenuCategoryMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_menus.name', '=', $name )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuId(int $id, AppMenuCategoryMenu $appMenuCategoryMenu):? AppMenuCategoryMenu
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->where('app_menus.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuIdList(int $id, AppMenuCategoryMenu $appMenuCategoryMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuCategoryMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_menus.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
