<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AppRoleRoute;
use App\Repositories\Requests\AppRoleRouteRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:04:01
 * Time: 2021/11/06
 * Trait AppRoleRouteRepositoryTrait
 * @package App\Repositories
 */
trait AppRoleRouteRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $roles = app()->make(Join::class);
        $roles->class = Role::class;
        $roles->foreign = 'app_role_routes.role_id';
        $roles->type = 'inner';
        $roles->primary = 'roles.id';
        $this->joinTable['roles'] = $roles;

        $app_routes = app()->make(Join::class);
        $app_routes->class = AppRoute::class;
        $app_routes->foreign = 'app_role_routes.route_id';
        $app_routes->type = 'inner';
        $app_routes->primary = 'app_routes.id';
        $this->joinTable['app_routes'] = $app_routes;

    }

    /**
     * @inheritDoc
     */
    public function store(AppRoleRouteRepositoryRequest $appRoleRouteRepositoryRequest, AppRoleRoute $appRoleRoute): ?AppRoleRoute
    {
        try {
            $appRoleRoute = Lazy::transform($appRoleRouteRepositoryRequest, $appRoleRoute);
            $appRoleRoute->save();
            return $appRoleRoute;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppRoleRouteRepositoryRequest $appRoleRouteRepositoryRequest, AppRoleRoute $appRoleRoute): ?AppRoleRoute
    {
        $appRoleRoute = $appRoleRoute->where('id', $id)->first();
        if($appRoleRoute != null){
            try {
                $appRoleRoute = Lazy::transform($appRoleRouteRepositoryRequest, $appRoleRoute);
                $appRoleRoute->save();
                return $appRoleRoute;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $appRoleRoute;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppRoleRoute $appRoleRoute): bool
    {
        $appRoleRoute = $appRoleRoute->where('app_role_routes.id',$id)->first();
        if($appRoleRoute!=null){
            return $appRoleRoute->delete();
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
    public function get(AppRoleRoute $appRoleRoute, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleRoute)
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
    public function getCount(AppRoleRoute $appRoleRoute, string $q = null): int
    {
        return $this
            ->getJoin($appRoleRoute)
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
    public function getByRouteIdRoleId(int $routeId, int $roleId, AppRoleRoute $appRoleRoute):? AppRoleRoute
    {
        return $this
            ->getJoin($appRoleRoute)
            ->where('app_role_routes.route_id', '=', $routeId )
            ->where('app_role_routes.role_id', '=', $roleId )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRouteIdRoleIdList(int $routeId, int $roleId, AppRoleRoute $appRoleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleRoute)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_role_routes.route_id', '=', $routeId )
            ->where('app_role_routes.role_id', '=', $roleId )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, AppRoleRoute $appRoleRoute):? AppRoleRoute
    {
        return $this
            ->getJoin($appRoleRoute)
            ->where('app_role_routes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppRoleRoute $appRoleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleRoute)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_role_routes.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleName(string $name, AppRoleRoute $appRoleRoute):? AppRoleRoute
    {
        return $this
            ->getJoin($appRoleRoute)
            ->where('roles.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleNameList(string $name, AppRoleRoute $appRoleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleRoute)
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
    public function getByRoleId(int $id, AppRoleRoute $appRoleRoute):? AppRoleRoute
    {
        return $this
            ->getJoin($appRoleRoute)
            ->where('roles.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleIdList(int $id, AppRoleRoute $appRoleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleRoute)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('roles.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteName(string $name, AppRoleRoute $appRoleRoute):? AppRoleRoute
    {
        return $this
            ->getJoin($appRoleRoute)
            ->where('app_routes.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteNameList(string $name, AppRoleRoute $appRoleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleRoute)
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
    public function getByAppRouteId(int $id, AppRoleRoute $appRoleRoute):? AppRoleRoute
    {
        return $this
            ->getJoin($appRoleRoute)
            ->where('app_routes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByAppRouteIdList(int $id, AppRoleRoute $appRoleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appRoleRoute)
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
