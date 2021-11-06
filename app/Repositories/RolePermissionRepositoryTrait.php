<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\RolePermission;
use App\Repositories\Requests\RolePermissionRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:04:30
 * Time: 2021/11/06
 * Trait RolePermissionRepositoryTrait
 * @package App\Repositories
 */
trait RolePermissionRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $users = app()->make(Join::class);
        $users->class = User::class;
        $users->foreign = 'role_permissions.created_by';
        $users->type = 'left';
        $users->primary = 'users.id';
        $this->joinTable['users'] = $users;

        $permissions = app()->make(Join::class);
        $permissions->class = Permission::class;
        $permissions->foreign = 'role_permissions.permission_id';
        $permissions->type = 'left';
        $permissions->primary = 'permissions.id';
        $this->joinTable['permissions'] = $permissions;

        $roles = app()->make(Join::class);
        $roles->class = Role::class;
        $roles->foreign = 'role_permissions.role_id';
        $roles->type = 'left';
        $roles->primary = 'roles.id';
        $this->joinTable['roles'] = $roles;

        $updated_by_users = app()->make(Join::class);
        $updated_by_users->class = User::class;
        $updated_by_users->foreign = 'role_permissions.updated_by';
        $updated_by_users->type = 'left';
        $updated_by_users->primary = 'updated_by_users.id';
        $this->joinTable['updated_by_users'] = $updated_by_users;

    }

    /**
     * @inheritDoc
     */
    public function store(RolePermissionRepositoryRequest $rolePermissionRepositoryRequest, RolePermission $rolePermission): ?RolePermission
    {
        try {
            $rolePermission = Lazy::transform($rolePermissionRepositoryRequest, $rolePermission);
            $rolePermission->save();
            return $rolePermission;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, RolePermissionRepositoryRequest $rolePermissionRepositoryRequest, RolePermission $rolePermission): ?RolePermission
    {
        $rolePermission = $rolePermission->where('id', $id)->first();
        if($rolePermission != null){
            try {
                $rolePermission = Lazy::transform($rolePermissionRepositoryRequest, $rolePermission);
                $rolePermission->save();
                return $rolePermission;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $rolePermission;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, RolePermission $rolePermission): bool
    {
        $rolePermission = $rolePermission->where('role_permissions.id',$id)->first();
        if($rolePermission!=null){
            return $rolePermission->delete();
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
    public function get(RolePermission $rolePermission, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
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
    public function getCount(RolePermission $rolePermission, string $q = null): int
    {
        return $this
            ->getJoin($rolePermission)
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
    public function getById(int $id, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('role_permissions.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('role_permissions.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.api_token', '=', $apiToken )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmail(string $email, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.email', '=', $email )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserId(int $id, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('users.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByPermissionId(int $id, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('permissions.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByPermissionIdList(int $id, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('permissions.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleName(string $name, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('roles.name', '=', $name )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleNameList(string $name, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
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
    public function getByRoleId(int $id, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('roles.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByRoleIdList(int $id, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
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
    public function getByUpdatedByUserApiToken(string $apiToken, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('updated_by_users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserApiTokenList(string $apiToken, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('updated_by_users.api_token', '=', $apiToken )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserEmail(string $email, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('updated_by_users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserEmailList(string $email, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('updated_by_users.email', '=', $email )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserId(int $id, RolePermission $rolePermission):? RolePermission
    {
        return $this
            ->getJoin($rolePermission)
            ->where('updated_by_users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserIdList(int $id, RolePermission $rolePermission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($rolePermission)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('updated_by_users.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
