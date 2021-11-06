<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Requests\PermissionRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:04:25
 * Time: 2021/11/06
 * Trait PermissionRepositoryTrait
 * @package App\Repositories
 */
trait PermissionRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $users = app()->make(Join::class);
        $users->class = User::class;
        $users->foreign = 'permissions.created_by';
        $users->type = 'left';
        $users->primary = 'users.id';
        $this->joinTable['users'] = $users;

        $updated_by_users = app()->make(Join::class);
        $updated_by_users->class = User::class;
        $updated_by_users->foreign = 'permissions.updated_by';
        $updated_by_users->type = 'left';
        $updated_by_users->primary = 'updated_by_users.id';
        $this->joinTable['updated_by_users'] = $updated_by_users;

    }

    /**
     * @inheritDoc
     */
    public function store(PermissionRepositoryRequest $permissionRepositoryRequest, Permission $permission): ?Permission
    {
        try {
            $permission = Lazy::transform($permissionRepositoryRequest, $permission);
            $permission->save();
            return $permission;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, PermissionRepositoryRequest $permissionRepositoryRequest, Permission $permission): ?Permission
    {
        $permission = $permission->where('id', $id)->first();
        if($permission != null){
            try {
                $permission = Lazy::transform($permissionRepositoryRequest, $permission);
                $permission->save();
                return $permission;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $permission;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, Permission $permission): bool
    {
        $permission = $permission->where('permissions.id',$id)->first();
        if($permission!=null){
            return $permission->delete();
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
    public function get(Permission $permission, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($permission)
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
    public function getCount(Permission $permission, string $q = null): int
    {
        return $this
            ->getJoin($permission)
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
    public function getById(int $id, Permission $permission):? Permission
    {
        return $this
            ->getJoin($permission)
            ->where('permissions.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, Permission $permission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($permission)
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
    public function getByUserApiToken(string $apiToken, Permission $permission):? Permission
    {
        return $this
            ->getJoin($permission)
            ->where('users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, Permission $permission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($permission)
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
    public function getByUserEmail(string $email, Permission $permission):? Permission
    {
        return $this
            ->getJoin($permission)
            ->where('users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, Permission $permission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($permission)
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
    public function getByUserId(int $id, Permission $permission):? Permission
    {
        return $this
            ->getJoin($permission)
            ->where('users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, Permission $permission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($permission)
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
    public function getByUpdatedByUserApiToken(string $apiToken, Permission $permission):? Permission
    {
        return $this
            ->getJoin($permission)
            ->where('updated_by_users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserApiTokenList(string $apiToken, Permission $permission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($permission)
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
    public function getByUpdatedByUserEmail(string $email, Permission $permission):? Permission
    {
        return $this
            ->getJoin($permission)
            ->where('updated_by_users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserEmailList(string $email, Permission $permission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($permission)
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
    public function getByUpdatedByUserId(int $id, Permission $permission):? Permission
    {
        return $this
            ->getJoin($permission)
            ->where('updated_by_users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUpdatedByUserIdList(int $id, Permission $permission, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($permission)
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
