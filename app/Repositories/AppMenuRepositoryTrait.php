<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AppMenu;
use App\Repositories\Requests\AppMenuRepositoryRequest;
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
 * Trait AppMenuRepositoryTrait
 * @package App\Repositories
 */
trait AppMenuRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $app_routes = app()->make(Join::class);
        $app_routes->class = AppRoute::class;
        $app_routes->foreign = 'app_menus.route_id';
        $app_routes->type = 'left';
        $app_routes->primary = 'app_routes.id';
        $this->joinTable['app_routes'] = $app_routes;

    }

    /**
     * @inheritDoc
     */
    public function store(AppMenuRepositoryRequest $appMenuRepositoryRequest, AppMenu $appMenu): ?AppMenu
    {
        try {
            $appMenu = Lazy::transform($appMenuRepositoryRequest, $appMenu);
            $appMenu->save();
            return $appMenu;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(string $name, AppMenuRepositoryRequest $appMenuRepositoryRequest, AppMenu $appMenu): ?AppMenu
    {
        $appMenu = $appMenu->where('name', $name)->first();
        if($appMenu != null){
            try {
                $appMenu = Lazy::transform($appMenuRepositoryRequest, $appMenu);
                $appMenu->save();
                return $appMenu;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $appMenu;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name, AppMenu $appMenu): bool
    {
        $appMenu = $appMenu->where('app_menus.name',$name)->first();
        if($appMenu!=null){
            return $appMenu->delete();
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
            return $query->where('app_menus.name', 'LIKE', '%' . $q . '%');
        });

    }

    /**
     * @inheritDoc
     */
    public function get(AppMenu $appMenu, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenu)
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
    public function getCount(AppMenu $appMenu, string $q = null): int
    {
        return $this
            ->getJoin($appMenu)
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
    public function getByName(string $name, AppMenu $appMenu):? AppMenu
    {
        return $this
            ->getJoin($appMenu)
            ->where('app_menus.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByNameList(string $name, AppMenu $appMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenu)
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
    public function getById(int $id, AppMenu $appMenu):? AppMenu
    {
        return $this
            ->getJoin($appMenu)
            ->where('app_menus.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppMenu $appMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenu)
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
    public function getByAppRouteName(string $name, AppMenu $appMenu):? AppMenu
    {
        return $this
            ->getJoin($appMenu)
            ->where('app_routes.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteNameList(string $name, AppMenu $appMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_routes.name', '=', $name )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteId(int $id, AppMenu $appMenu):? AppMenu
    {
        return $this
            ->getJoin($appMenu)
            ->where('app_routes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteIdList(int $id, AppMenu $appMenu, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenu)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_routes.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
