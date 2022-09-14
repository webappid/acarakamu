<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\RoleRoute;
use App\Repositories\Requests\RoleRouteRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;
use WebAppId\User\Models\Role;
use WebAppId\User\Models\Route;

/**
 * @author: 
 * Date: 16:04:21
 * Time: 2022/09/14
 * Trait RoleRouteRepositoryTrait
 * @package App\Repositories
 */
trait RoleRouteRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $roles = app()->make(Join::class);
        $roles->class = Role::class;
        $roles->foreign = 'role_routes.role_id';
        $roles->type = 'inner';
        $roles->primary = 'roles.id';
        $this->joinTable['roles'] = $roles;

        $routes = app()->make(Join::class);
        $routes->class = Route::class;
        $routes->foreign = 'role_routes.route_id';
        $routes->type = 'inner';
        $routes->primary = 'routes.id';
        $this->joinTable['routes'] = $routes;

    }

    /**
     * @inheritDoc
     */
    public function store(RoleRouteRepositoryRequest $roleRouteRepositoryRequest, RoleRoute $roleRoute): ?RoleRoute
    {
        try {
            $roleRoute = Lazy::transform($roleRouteRepositoryRequest, $roleRoute);
            $roleRoute->save();
            return $roleRoute;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, RoleRouteRepositoryRequest $roleRouteRepositoryRequest, RoleRoute $roleRoute): ?RoleRoute
    {
        $roleRoute = $roleRoute->where('id', $id)->first();
        if($roleRoute != null){
            try {
                $roleRoute = Lazy::transform($roleRouteRepositoryRequest, $roleRoute);
                $roleRoute->save();
                return $roleRoute;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $roleRoute;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, RoleRoute $roleRoute): bool
    {
        $roleRoute = $roleRoute->where('role_routes.id',$id)->first();
        if($roleRoute!=null){
            return $roleRoute->delete();
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
    public function get(RoleRoute $roleRoute, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($roleRoute)
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
    public function getCount(RoleRoute $roleRoute, string $q = null): int
    {
        return $this
            ->getJoin($roleRoute)
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
    public function getById(int $id, RoleRoute $roleRoute):? RoleRoute
    {
        return $this
            ->getJoin($roleRoute)
            ->where('role_routes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, RoleRoute $roleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($roleRoute)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('role_routes.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleName(string $name, RoleRoute $roleRoute):? RoleRoute
    {
        return $this
            ->getJoin($roleRoute)
            ->where('roles.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleNameList(string $name, RoleRoute $roleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($roleRoute)
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
    public function getByRoleId(int $id, RoleRoute $roleRoute):? RoleRoute
    {
        return $this
            ->getJoin($roleRoute)
            ->where('roles.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleIdList(int $id, RoleRoute $roleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($roleRoute)
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
    public function getByRouteName(string $name, RoleRoute $roleRoute):? RoleRoute
    {
        return $this
            ->getJoin($roleRoute)
            ->where('routes.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRouteNameList(string $name, RoleRoute $roleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($roleRoute)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('routes.name', '=', $name )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByRouteId(int $id, RoleRoute $roleRoute):? RoleRoute
    {
        return $this
            ->getJoin($roleRoute)
            ->where('routes.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRouteIdList(int $id, RoleRoute $roleRoute, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($roleRoute)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('routes.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
