<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AppMenuRoute;
use App\Repositories\Requests\AppMenuRouteRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:03:59
 * Time: 2021/11/06
 * Trait AppMenuRouteRepositoryTrait
 * @package App\Repositories
 */
trait AppMenuRouteRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $app_menus = app()->make(Join::class);
        $app_menus->class = AppMenu::class;
        $app_menus->foreign = 'app_menu_routes.menu_id';
        $app_menus->type = 'inner';
        $app_menus->primary = 'app_menus.id';
        $this->joinTable['app_menus'] = $app_menus;

        $app_routes = app()->make(Join::class);
        $app_routes->class = AppRoute::class;
        $app_routes->foreign = 'app_menu_routes.route_id';
        $app_routes->type = 'inner';
        $app_routes->primary = 'app_routes.id';
        $this->joinTable['app_routes'] = $app_routes;

    }

    /**
     * @inheritDoc
     */
    public function store(AppMenuRouteRepositoryRequest $appMenuRouteRepositoryRequest, AppMenuRoute $appMenuRoute): ?AppMenuRoute
    {
        try {
            $appMenuRoute = Lazy::transform($appMenuRouteRepositoryRequest, $appMenuRoute);
            $appMenuRoute->save();
            return $appMenuRoute;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppMenuRouteRepositoryRequest $appMenuRouteRepositoryRequest, AppMenuRoute $appMenuRoute): ?AppMenuRoute
    {
        $appMenuRoute = $appMenuRoute->where('id', $id)->first();
        if($appMenuRoute != null){
            try {
                $appMenuRoute = Lazy::transform($appMenuRouteRepositoryRequest, $appMenuRoute);
                $appMenuRoute->save();
                return $appMenuRoute;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $appMenuRoute;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppMenuRoute $appMenuRoute): bool
    {
        $appMenuRoute = $appMenuRoute->where('app_menu_routes.id',$id)->first();
        if($appMenuRoute!=null){
            return $appMenuRoute->delete();
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
    public function get(AppMenuRoute $appMenuRoute, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuRoute)
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
    public function getCount(AppMenuRoute $appMenuRoute, string $q = null): int
    {
        return $this
            ->getJoin($appMenuRoute)
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
    public function getById(int $id, AppMenuRoute $appMenuRoute):? AppMenuRoute
    {
        return $this
            ->getJoin($appMenuRoute)
            ->where('app_menu_routes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppMenuRoute $appMenuRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuRoute)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_menu_routes.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuName(string $name, AppMenuRoute $appMenuRoute):? AppMenuRoute
    {
        return $this
            ->getJoin($appMenuRoute)
            ->where('app_menus.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuNameList(string $name, AppMenuRoute $appMenuRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuRoute)
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
    public function getByAppMenuId(int $id, AppMenuRoute $appMenuRoute):? AppMenuRoute
    {
        return $this
            ->getJoin($appMenuRoute)
            ->where('app_menus.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppMenuIdList(int $id, AppMenuRoute $appMenuRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuRoute)
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
    public function getByAppRouteName(string $name, AppMenuRoute $appMenuRoute):? AppMenuRoute
    {
        return $this
            ->getJoin($appMenuRoute)
            ->where('app_routes.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteNameList(string $name, AppMenuRoute $appMenuRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuRoute)
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
    public function getByAppRouteId(int $id, AppMenuRoute $appMenuRoute):? AppMenuRoute
    {
        return $this
            ->getJoin($appMenuRoute)
            ->where('app_routes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteIdList(int $id, AppMenuRoute $appMenuRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appMenuRoute)
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
