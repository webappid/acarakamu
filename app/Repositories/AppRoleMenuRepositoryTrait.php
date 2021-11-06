<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AppRoleMenu;
use App\Repositories\Requests\AppRoleMenuRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:04:00
 * Time: 2021/11/06
 * Trait AppRoleMenuRepositoryTrait
 * @package App\Repositories
 */
trait AppRoleMenuRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $app_menus = app()->make(Join::class);
        $app_menus->class = AppMenu::class;
        $app_menus->foreign = 'app_role_menus.menu_id';
        $app_menus->type = 'inner';
        $app_menus->primary = 'app_menus.id';
        $this->joinTable['app_menus'] = $app_menus;

        $roles = app()->make(Join::class);
        $roles->class = Role::class;
        $roles->foreign = 'app_role_menus.role_id';
        $roles->type = 'inner';
        $roles->primary = 'roles.id';
        $this->joinTable['roles'] = $roles;

    }

    /**
     * @inheritDoc
     */
    public function store(AppRoleMenuRepositoryRequest $appRoleMenuRepositoryRequest, AppRoleMenu $appRoleMenu): ?AppRoleMenu
    {
        try {
            $appRoleMenu = Lazy::transform($appRoleMenuRepositoryRequest, $appRoleMenu);
            $appRoleMenu->save();
            return $appRoleMenu;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppRoleMenuRepositoryRequest $appRoleMenuRepositoryRequest, AppRoleMenu $appRoleMenu): ?AppRoleMenu
    {
        $appRoleMenu = $appRoleMenu->where('id', $id)->first();
        if($appRoleMenu != null){
            try {
                $appRoleMenu = Lazy::transform($appRoleMenuRepositoryRequest, $appRoleMenu);
                $appRoleMenu->save();
                return $appRoleMenu;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $appRoleMenu;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppRoleMenu $appRoleMenu): bool
    {
        $appRoleMenu = $appRoleMenu->where('app_role_menus.id',$id)->first();
        if($appRoleMenu!=null){
            return $appRoleMenu->delete();
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
    public function get(AppRoleMenu $appRoleMenu, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleMenu)
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
    public function getCount(AppRoleMenu $appRoleMenu, string $q = null): int
    {
        return $this
            ->getJoin($appRoleMenu)
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
    public function getByMenuIdRoleId(int $menuId, int $roleId, AppRoleMenu $appRoleMenu):? AppRoleMenu
    {
        return $this
            ->getJoin($appRoleMenu)
            ->where('app_role_menus.menu_id', '=', $menuId )
            ->where('app_role_menus.role_id', '=', $roleId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByMenuIdRoleIdList(int $menuId, int $roleId, AppRoleMenu $appRoleMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_role_menus.menu_id', '=', $menuId )
            ->where('app_role_menus.role_id', '=', $roleId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AppRoleMenu $appRoleMenu):? AppRoleMenu
    {
        return $this
            ->getJoin($appRoleMenu)
            ->where('app_role_menus.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppRoleMenu $appRoleMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_role_menus.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuName(string $name, AppRoleMenu $appRoleMenu):? AppRoleMenu
    {
        return $this
            ->getJoin($appRoleMenu)
            ->where('app_menus.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuNameList(string $name, AppRoleMenu $appRoleMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleMenu)
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
    public function getByAppMenuId(int $id, AppRoleMenu $appRoleMenu):? AppRoleMenu
    {
        return $this
            ->getJoin($appRoleMenu)
            ->where('app_menus.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuIdList(int $id, AppRoleMenu $appRoleMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_menus.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleName(string $name, AppRoleMenu $appRoleMenu):? AppRoleMenu
    {
        return $this
            ->getJoin($appRoleMenu)
            ->where('roles.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleNameList(string $name, AppRoleMenu $appRoleMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('roles.name', '=', $name )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleId(int $id, AppRoleMenu $appRoleMenu):? AppRoleMenu
    {
        return $this
            ->getJoin($appRoleMenu)
            ->where('roles.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleIdList(int $id, AppRoleMenu $appRoleMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('roles.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
