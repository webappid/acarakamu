<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace App\Repositories;

use App\Models\AppSetting;
use App\Repositories\Requests\AppSettingRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Lazy\Models\Join;
use WebAppId\Lazy\Tools\Lazy;
use WebAppId\Lazy\Traits\RepositoryTrait;

/**
 * @author: 
 * Date: 14:04:03
 * Time: 2021/11/06
 * Trait AppSettingRepositoryTrait
 * @package App\Repositories
 */
trait AppSettingRepositoryTrait
{

    use RepositoryTrait;

    protected function init(){
        $users = app()->make(Join::class);
        $users->class = User::class;
        $users->foreign = 'app_settings.creator_id';
        $users->type = 'inner';
        $users->primary = 'users.id';
        $this->joinTable['users'] = $users;

        $owner_users = app()->make(Join::class);
        $owner_users->class = User::class;
        $owner_users->foreign = 'app_settings.owner_id';
        $owner_users->type = 'inner';
        $owner_users->primary = 'owner_users.id';
        $this->joinTable['owner_users'] = $owner_users;

        $user_users = app()->make(Join::class);
        $user_users->class = User::class;
        $user_users->foreign = 'app_settings.user_id';
        $user_users->type = 'inner';
        $user_users->primary = 'user_users.id';
        $this->joinTable['user_users'] = $user_users;

    }

    /**
     * @inheritDoc
     */
    public function store(AppSettingRepositoryRequest $appSettingRepositoryRequest, AppSetting $appSetting): ?AppSetting
    {
        try {
            $appSetting = Lazy::transform($appSettingRepositoryRequest, $appSetting);
            $appSetting->save();
            return $appSetting;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, AppSettingRepositoryRequest $appSettingRepositoryRequest, AppSetting $appSetting): ?AppSetting
    {
        $appSetting = $appSetting->where('id', $id)->first();
        if($appSetting != null){
            try {
                $appSetting = Lazy::transform($appSettingRepositoryRequest, $appSetting);
                $appSetting->save();
                return $appSetting;
            }catch (QueryException $queryException){
                report($queryException);
                return null;
            }
        }
        return $appSetting;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, AppSetting $appSetting): bool
    {
        $appSetting = $appSetting->where('app_settings.id',$id)->first();
        if($appSetting!=null){
            return $appSetting->delete();
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
    public function get(AppSetting $appSetting, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
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
    public function getCount(AppSetting $appSetting, string $q = null): int
    {
        return $this
            ->getJoin($appSetting)
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
    public function getById(int $id, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('app_settings.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByIdList(int $id, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('app_settings.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiToken(string $apiToken, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserApiTokenList(string $apiToken, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
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
    public function getByUserEmail(string $email, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserEmailList(string $email, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
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
    public function getByUserId(int $id, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserIdList(int $id, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
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
    public function getByOwnerUserApiToken(string $apiToken, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('owner_users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserApiTokenList(string $apiToken, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('owner_users.api_token', '=', $apiToken )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserEmail(string $email, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('owner_users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserEmailList(string $email, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('owner_users.email', '=', $email )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserId(int $id, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('owner_users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByOwnerUserIdList(int $id, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('owner_users.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiToken(string $apiToken, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('user_users.api_token', '=', $apiToken )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserApiTokenList(string $apiToken, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('user_users.api_token', '=', $apiToken )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmail(string $email, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('user_users.email', '=', $email )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserEmailList(string $email, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('user_users.email', '=', $email )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserId(int $id, AppSetting $appSetting):? AppSetting
    {
        return $this
            ->getJoin($appSetting)
            ->where('user_users.id', '=', $id )
            ->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByUserUserIdList(int $id, AppSetting $appSetting, string $q = null, int $length = 12): LengthAwarePaginator
    {
        return $this
            ->getJoin($appSetting)
            ->when($q != null, function ($query) use ($q) {
                return $query->where(function($query) use($q){
                    return $this->getFilter($query, $q);
                });
            })
            ->where('user_users.id', '=', $id )
            ->paginate($length, $this->getColumn())
            ->appends(request()->input());
    }

}
